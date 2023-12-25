<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = DB::table('books')
            ->join('authors', 'books.author_id', '=', 'authors.id')
            ->join('categories', 'books.category_id', '=', 'categories.id')
            ->join('genres', 'books.genre_id', '=', 'genres.id')
            ->select('books.*', 'authors.fullname as author_name', 'categories.description as category_description', 'genres.description as genre_description')
            ->get();

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = DB::table('genres')->get();
        $authors = DB::table('authors')->get();
        $categories = DB::table('categories')->get();
        $users = DB::table('users')->where('role_id','=','1')->get();

        return view('books.create', compact('genres', 'authors', 'categories', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
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
            $genres = DB::table('genres')->get();
            $authors = DB::table('authors')->get();
            $categories = DB::table('categories')->get();
            $users = DB::table('users')->where('role_id','=','1')->get();

            return view('books.create', compact('genres', 'authors', 'categories', 'users'))->with('errors', $validator->errors());
        }

        $isbn_verify = DB::table('books')->where('isbn', '=', $request->isbn)->get();

        if (count($isbn_verify) > 0) {
            $genres = DB::table('genres')->get();
            $authors = DB::table('authors')->get();
            $categories = DB::table('categories')->get();
            $users = DB::table('users')->where('role_id','=','1')->get();

            return view('books.create', compact('genres', 'authors', 'categories', 'users'))->withErrors(['isbn' => 'ISBN already exists.']);
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
        $book->user_created_id = auth()->user()->id;
        $book->active = true;
        
        if (!$book->save()) {
            $genres = DB::table('genres')->get();
            $authors = DB::table('authors')->get();
            $categories = DB::table('categories')->get();
            $users = DB::table('users')->where('role_id','=','1')->get();

            return view('books.create', compact('genres', 'authors', 'categories', 'users'))->with('errors', $validator->errors());
        }

        return redirect('/books')->with('success', 'Book saved!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {

        $genres = DB::table('genres')->get();
        $authors = DB::table('authors')->get();
        $categories = DB::table('categories')->get();
        $users = DB::table('users')->where('role_id','=','1')->get();

        $books = Book::findOrFail($book->id);
        if (!$books) {
            return redirect('/books')->with('errors', 'Genre not found!');
        }

        return view('books.show', compact('books', 'genres', 'authors', 'categories', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $genres = DB::table('genres')->get();
        $authors = DB::table('authors')->get();
        $categories = DB::table('categories')->get();
        $users = DB::table('users')->where('role_id','=','1')->get();

        $books = Book::findOrFail($book->id);
        if (!$books) {
            return redirect('/books')->with('errors', 'Genre not found!');
        }

        return view('books.edit', compact('books', 'genres', 'authors', 'categories', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
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
            $genres = DB::table('genres')->get();
            $authors = DB::table('authors')->get();
            $categories = DB::table('categories')->get();
            $users = DB::table('users')->where('role_id','=','1')->get();

            return view('books.edit', compact('genres', 'authors', 'categories', 'users'))->with('errors', $validator->errors());
        }

        $books = Book::findOrFail($book->id);
        if (!$books) {
            $genres = DB::table('genres')->get();
            $authors = DB::table('authors')->get();
            $categories = DB::table('categories')->get();
            $users = DB::table('users')->where('role_id','=','1')->get();

            return redirect('books.edit', compact('genres', 'authors', 'categories', 'users'))->with('errors', 'Book not found!');
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
        $book->user_created_id = auth()->user()->id;
        $book->active = true;
        
        if (!$book->save()) {
            $genres = DB::table('genres')->get();
            $authors = DB::table('authors')->get();
            $categories = DB::table('categories')->get();
            $users = DB::table('users')->where('role_id','=','1')->get();

            return view('books.edit', compact('genres', 'authors', 'categories', 'users'))->with('errors', 'Book not saved!');
        }

        return redirect('/books')->with('success', 'Book saved!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $books = Book::findOrFail($book->id);
        if (!$books) {
            return redirect('/books')->with('errors', 'Book not found!');
        }

        if (!$books->delete()) {
            return redirect('/books')->with('errors', 'Book not deleted!');
        }

        return redirect('/books')->with('success', 'Book deleted!');
    }
}
