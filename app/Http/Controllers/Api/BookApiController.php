<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BookApiController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (!Auth::guard('api')->user()) {
            return response()->json([
                'status' => 'error',
                'message' => 'You are not authorized to view books.'
            ], 403);
        }

        $books = DB::table('books')
            ->join('authors', 'books.author_id', '=', 'authors.id')
            ->join('categories', 'books.category_id', '=', 'categories.id')
            ->join('genres', 'books.genre_id', '=', 'genres.id')
            ->select('books.*', 'authors.fullname as author_name', 'categories.description as category_description', 'genres.description as genre_description')
            ->get();

        if (!$books) {
            return response()->json([
                'status' => 'error',
                'message' => 'Books not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $books
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if (!Auth::guard('api')->user() || !Auth::guard('api')->user()->hasRole('librarian')) {
            return response()->json([
                'status' => 'error',
                'message' => 'You are not authorized to create books.'
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'isbn' => 'required | string | max:255',
            'title' => 'required | string',
            'description' => 'required | string',
            'genre_id' => 'required | integer | exists:genres,id',
            'author_id' => 'required | integer | exists:authors,id',
            'category_id' => 'required | integer | exists:categories,id',
            'total_copies' => 'required | integer',
            'available_copies' => 'required | integer',
            'published_at' => 'required | date',
            'format' => 'required | string | max:255',
            'pages' => 'required | integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $isbn_verify = DB::table('books')->where('isbn', '=', $request->isbn)->get();
        if (count($isbn_verify) > 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'ISBN already exists'
            ], 400);
        }

        $book = new Book();
        $book->isbn = $request->isbn;
        $book->title = $request->title;
        $book->description = $request->description;
        $book->genre_id = $request->genre_id;
        $book->author_id = $request->author_id;
        $book->category_id = $request->category_id;
        $book->total_copies = $request->total_copies;
        $book->available_copies = $request->available_copies;
        $book->published_at = Carbon::parse($request->published_at)->format('Y-m-d');
        $book->format = $request->format;
        $book->pages = $request->pages;
        $book->user_created_id = Auth::guard('api')->user()->id;
        
        if (!$book->save()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Book not created'
            ], 400);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Book created successfully'
        ], 200);

    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        if (!Auth::guard('api')->user() || !Auth::guard('api')->user()->hasRole('librarian')) {
            return response()->json([
                'status' => 'error',
                'message' => 'You are not authorized to view this book.'
            ], 403);
        }

        $book = DB::table('books')
            ->join('genres', 'books.genre_id', '=', 'genres.id')
            ->join('authors', 'books.author_id', '=', 'authors.id')
            ->join('categories', 'books.category_id', '=', 'categories.id')
            ->join('users', 'books.user_created_id', '=', 'users.id')
            ->select('books.*', 'genres.description as genre_name', 'authors.fullname as author_name', 'categories.description as category_name', 'users.fullname as user_created_name')
            ->where('books.id', '=', $book->id)
            ->first();
        
        if (!$book) {
            return response()->json([
                'status' => 'error',
                'message' => 'Book not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $book
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {

        if (!Auth::guard('api')->user() || !Auth::guard('api')->user()->hasRole('librarian')) {
            return response()->json([
                'status' => 'error',
                'message' => 'You are not authorized to update this book'
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'isbn' => 'required | string | max:255',
            'title' => 'required | string',
            'description' => 'required | string',
            'genre_id' => 'required | integer | exists:genres,id',
            'author_id' => 'required | integer | exists:authors,id',
            'category_id' => 'required | integer | exists:categories,id',
            'total_copies' => 'required | integer',
            'available_copies' => 'required | integer',
            'published_at' => 'required | date',
            'format' => 'required | string | max:255',
            'pages' => 'required | integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $book = Book::findOrFail($book->id);
        if (!$book) {
            return response()->json([
                'status' => 'error',
                'message' => 'Book not found'
            ], 404);
        }

        $book->isbn = $request->isbn;
        $book->title = $request->title;
        $book->description = $request->description;
        $book->genre_id = $request->genre_id;
        $book->author_id = $request->author_id;
        $book->category_id = $request->category_id;
        $book->total_copies = $request->total_copies;
        $book->available_copies = $request->available_copies;
        $book->published_at = Carbon::parse($request->published_at)->format('Y-m-d');
        $book->format = $request->format;
        $book->pages = $request->pages;
        $book->user_created_id = Auth::guard('api')->user()->id;
        
        if (!$book->save()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Book not updated'
            ], 400);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Book updated successfully'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        if (!Auth::guard('api')->user() || !Auth::guard('api')->user()->hasRole('librarian')) {
            return response()->json([
                'status' => 'error',
                'message' => 'You are not authorized to delete this book'
            ], 403);
        }

        Book::findOrFail($book->id);
        if (!$book) {
            return response()->json([
                'status' => 'error',
                'message' => 'Book not found'
            ], 404);
        }

        if (!$book->delete()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Book not deleted'
            ], 400);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Book deleted successfully'
        ], 200);
    }
}
