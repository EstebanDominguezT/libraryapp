<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrow;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BorrowApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::guard('api')->user()) {
            return response()->json([
                'status' => 'error',
                'message' => 'You are not authorized to view borrows.'
            ], 403);
        }

        $borrows = DB::table('borrows')
            ->join('users', 'borrows.user_id', '=', 'users.id')
            ->join('books', 'borrows.book_id', '=', 'books.id')
            ->select('borrows.*', 'users.fullname as user_fullname', 'users.id as user_id', 'books.title as book_title', 'books.isbn as book_isbn')
            ->where('borrows.user_id', '=', Auth::guard('api')->user()->id)
            ->get();

        if (!$borrows) {
            return response()->json([
                'status' => 'error',
                'message' => 'Borrows not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $borrows
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::guard('api')->user()) {
            return response()->json([
                'status' => 'error',
                'message' => 'You are not authorized to create borrows.'
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'user_id' => 'required | integer | exists:users,id',
            'book_id' => 'required | integer | exists:books,id',
            'borrowed_at' => 'required | date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        // Check if book is available
        $book = DB::table('books')->find($request->book_id);
        if ($book->available_copies <= 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'No available copies for the selected book.'
            ], 400);
        }

        // Check if user has already borrowed the book
        $borrowed_books = DB::table('borrows')->where('book_id', '=', $request->book_id)->where('returned_at', '=', null)->where('user_id','=', $request->user_id)->get();
        if (count($borrowed_books) > 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'User has already borrowed the selected book.'
            ], 400);
        }

        $borrow = new Borrow();
        $borrow->user_id = $request->user_id;
        $borrow->book_id = $request->book_id;
        $borrow->borrowed_at = Carbon::parse($request->borrowed_at)->format('Y-m-d');
        $borrow->due_at = Carbon::parse($request->borrowed_at)->addWeek(2)->format('Y-m-d');
        $borrow->status = 'borrowed';

        if (!$borrow->save()) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occured while saving the borrow.'
            ], 500);
        } else {

            // Update book available copies
            $book = Book::findOrFail($request->book_id);
            $book->available_copies = $book->available_copies - 1;
            $book->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Borrow created successfully.'
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Borrow $borrow)
    {
        if (!Auth::guard('api')->user()) {
            return response()->json([
                'status' => 'error',
                'message' => 'You are not authorized to view this borrow.'
            ], 403);
        }

        $borrow = DB::table('borrows')
            ->join('users as us', 'borrows.user_id', '=', 'us.id')
            ->join('books', 'borrows.book_id', '=', 'books.id')
            ->join('users as uc', 'borrows.user_returned_id', '=', 'uc.id', 'left')
            ->select('borrows.*', 'us.fullname as user_fullname', 'us.id as user_id', 'books.title as book_title', 'books.isbn as book_isbn', 'uc.fullname as user_returned_fullname', 'uc.id as user_returned_id')
            ->where('borrows.id', '=', $borrow->id)
            ->first();
        
        if (!$borrow) {
            return response()->json([
                'status' => 'error',
                'message' => 'Borrow not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $borrow
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Borrow $borrow)
    {
        
        if (!Auth::guard('api')->user() || !Auth::guard('api')->user()->hasRole('librarian')) {
            return response()->json([
                'status' => 'error',
                'message' => 'You are not authorized to update this borrow.'
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'user_id' => 'required | integer | exists:users,id',
            'book_id' => 'required | integer | exists:books,id',
            'borrowed_at' => 'required | date',
            'due_at' => 'required | date',
            'status' => 'required | string | max:255',
            'returned_at' => 'nullable | date',
            'user_returned_id' => 'nullable | integer | exists:users,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $borrow = Borrow::findOrFail($borrow->id);

        if (!$borrow) {
            return response()->json([
                'status' => 'error',
                'message' => 'Borrow not found'
            ], 404);
        }

        if ($borrow->returned_at != null && $borrow->status == 'returned') {
            return response()->json([
                'status' => 'error',
                'message' => 'Borrow already returned.'
            ], 400);
        }

        $borrow->user_id = $request->user_id;
        $borrow->book_id = $request->book_id;
        $borrow->borrowed_at = Carbon::parse($request->borrowed_at)->format('Y-m-d');
        $borrow->due_at = Carbon::parse($request->due_at)->format('Y-m-d');
        $borrow->status = $request->status;
        $borrow->returned_at = Carbon::parse($request->returned_at)->format('Y-m-d');
        $borrow->user_returned_id = $request->user_returned_id;
        $borrow->notes = $request->notes;

        if (!$borrow->save()) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occured while updating the borrow.'
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Borrow updated successfully.'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Borrow $borrow)
    {
        if (!Auth::guard('api')->user() || !Auth::guard('api')->user()->hasRole('librarian')) {
            return response()->json([
                'status' => 'error',
                'message' => 'You are not authorized to delete this borrow.'
            ], 403);
        }

        $borrow = Borrow::findOrFail($borrow->id);

        if (!$borrow) {
            return response()->json([
                'status' => 'error',
                'message' => 'Borrow not found'
            ], 404);
        }

        if ($borrow->returned_at != null && $borrow->status == 'returned') {
            return response()->json([
                'status' => 'error',
                'message' => 'Borrow already returned.'
            ], 400);
        }

        $book = Book::findOrFail($borrow->book_id);
        $book->available_copies = $book->available_copies + 1;
        $book->save();

        if (!$borrow->delete()) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occured while deleting the borrow.'
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Borrow deleted successfully.'
        ], 200);
    }
}
