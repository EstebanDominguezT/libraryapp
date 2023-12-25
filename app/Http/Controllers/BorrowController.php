<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->hasRole('librarian')) {
            $borrows = DB::table('borrows')
                ->join('users', 'borrows.user_id', '=', 'users.id')
                ->join('books', 'borrows.book_id', '=', 'books.id')
                ->select('borrows.*', 'users.fullname as user_fullname', 'users.id as user_id', 'books.title as book_title', 'books.isbn as book_isbn')
                ->get();
        } elseif (Auth::user()->hasRole('member')) {
            $borrows = DB::table('borrows')
                ->join('users', 'borrows.user_id', '=', 'users.id')
                ->join('books', 'borrows.book_id', '=', 'books.id')
                ->select('borrows.*', 'users.fullname as user_fullname', 'users.id as user_id', 'books.title as book_title', 'books.isbn as book_isbn')
                ->where('borrows.user_id', '=', Auth::user()->id)
                ->get();
        }
        
        return view('borrows.index', compact('borrows'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $books = DB::table('books')->get();
        $users = DB::table('users')->where('role_id','!=','1')->get();

        return view('borrows.create', compact('books', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {        
        $validator = Validator::make($request->all(), [
            'user_id' => 'required | integer | exists:users,id',
            'book_id' => 'required | integer | exists:books,id',
            'borrowed_at' => 'required | date',
            'due_at' => 'required | date',
            'status' => 'required | string | max:255'
        ]);

        if ($validator->fails()) {
            $books = DB::table('books')->get();
            $users = DB::table('users')->where('role_id','!=','1')->get();
    
            return view('borrows.create', compact('books', 'users'))->with('errors', $validator->errors());
        }

        // Check if book is available
        $book = DB::table('books')->find($request->book_id);
        if ($book->available_copies <= 0) {
            $books = DB::table('books')->get();
            $users = DB::table('users')->where('role_id', '!=', '1')->get();

            return view('borrows.create', compact('books', 'users'))->withErrors(['book_id' => 'No available copies for the selected book.']);
        }

        // Check if user has already borrowed the book
        $borrowed_books = DB::table('borrows')->where('book_id', '=', $request->book_id)->where('returned_at', '=', null)->where('user_id','=', $request->user_id)->get();
        if (count($borrowed_books) > 0) {
            $books = DB::table('books')->get();
            $users = DB::table('users')->where('role_id','!=','1')->get();

            return view('borrows.create', compact('books', 'users'))->withErrors(['book_id' => 'Book is already borrowed, you cannot borrow multiple copies of the same book.']);
        }

        $borrow = new Borrow();
        $borrow->user_id = $request->user_id;
        $borrow->book_id = $request->book_id;
        $borrow->borrowed_at = Carbon::parse($request->borrowed_at)->format('Y-m-d');
        $borrow->due_at = Carbon::parse($request->due_at)->format('Y-m-d');
        $borrow->status = $request->status;
        
        if (!$borrow->save()) {
            $books = DB::table('books')->get();
            $users = DB::table('users')->where('role_id','!=','1')->get();
    
            return view('borrows.create', compact('books', 'users'))->with('errors', 'An error occured while saving the borrow.');
        } else {
            
            // Update book available copies
            $book = Book::find($request->book_id);
            $book->available_copies = $book->available_copies - 1;
            $book->save();
        }

        return redirect()->route('borrows.index')->with('success', 'Borrow created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Borrow $borrow)
    {
        $borrow = DB::table('borrows')
            ->join('users as us', 'borrows.user_id', '=', 'us.id')
            ->join('books', 'borrows.book_id', '=', 'books.id')
            ->join('users as uc', 'borrows.user_returned_id', '=', 'uc.id', 'left')
            ->select('borrows.*', 'us.fullname as user_fullname', 'us.id as user_id', 'books.title as book_title', 'books.isbn as book_isbn', 'uc.fullname as user_returned_fullname', 'uc.id as user_returned_id')
            ->where('borrows.id', '=', $borrow->id)
            ->first();
        
        if (!$borrow) {
            return redirect()->route('borrows.index')->with('errors', 'Borrow not found.');
        }

        return view('borrows.show', compact('borrow'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Borrow $borrow)
    {
        $borrows = Borrow::find($borrow->id);
        if (!$borrows) {
            return redirect()->route('borrows.index')->with('errors', 'Borrow not found.');
        }

        if ($borrows->returned_at != null && $borrows->status == 'returned') {
            return redirect()->route('borrows.index')->with('errors', 'Borrow already returned.');
        }

        $books = DB::table('books')->get();
        $users = DB::table('users')->where('role_id','!=','1')->get();

        return view('borrows.edit', compact('borrows', 'books', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Borrow $borrow)
    {
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
            $books = DB::table('books')->get();
            $users = DB::table('users')->where('role_id','!=','1')->get();
    
            return view('borrows.create', compact('books', 'users'))->with('errors', $validator->errors());
        }

        // Check if book is returned
        if ($request->status == 'returned' && $request->returned_at == null) {
            $books = DB::table('books')->get();
            $users = DB::table('users')->where('role_id','!=','1')->get();

            return view('borrows.create', compact('books', 'users'))->withErrors(['returned_at' => 'Returned at field is required.']);
        }

        $borrow = Borrow::find($borrow->id);

        if (!$borrow) {
            return redirect()->route('borrows.index')->with('errors', 'Borrow not found.');
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
            $books = DB::table('books')->get();
            $users = DB::table('users')->where('role_id','!=','1')->get();
    
            return view('borrows.create', compact('books', 'users'))->with('errors', 'An error occured while saving the borrow.');
        }

        return redirect()->route('borrows.index')->with('success', 'Borrow updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Borrow $borrow)
    {
        $borrow = Borrow::find($borrow->id);
        if (!$borrow) {
            return redirect()->route('borrows.index')->with('errors', 'Borrow not found.');
        }

        if ($borrow->returned_at != null && $borrow->status == 'returned') {
            return redirect()->route('borrows.index')->with('errors', 'Borrow already returned.');
        }

        $book = Book::find($borrow->book_id);
        if (!$book) {
            return redirect()->route('borrows.index')->with('errors', 'Book not found.');
        }

        $book->available_copies = $book->available_copies + 1;
        $book->save();
        if (!$book->save()) {
            return redirect()->route('borrows.index')->with('errors', 'An error occured while updating the book available copies.');
        }

        if (!$borrow->delete()) {
            return redirect()->route('borrows.index')->with('errors', 'An error occured while deleting the borrow.');
        }
        

        if (!$book->save()) {
            return redirect()->route('borrows.index')->with('errors', 'An error occured while updating the book available copies.');
        }
        
        return redirect()->route('borrows.index')->with('success', 'Borrow deleted successfully.');
    }
}
