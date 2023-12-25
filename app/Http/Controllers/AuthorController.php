<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::all();
        return view('authors.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('authors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required | string | max:255',
            'born_date' => 'required | date',
            'biography' => 'required | string',
        ]);

        if ($validator->fails()) {
            return view('authors.create')->with('errors', $validator->errors());
        }

        $author = new Author();
        $author->fullname = $request->fullname;
        $author->born_date = $request->born_date;
        $author->email = $request->email;
        $author->biography = $request->biography;
        $author->awards = $request->awards;
        $author->published_books = $request->published_books;
        $author->user_created_id = auth()->user()->id;
        $author->active = true;
        
        if (!$author->save()) {
            return view('authors.create')->with('errors', 'Author not saved!');
        }
        
        return redirect('/authors')->with('success', 'Author saved!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        $author = Author::find($author->id);
        if (!$author) {
            return redirect('/authors')->with('errors', 'Author not found!');
        }

        return view('authors.show', compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        $author = Author::find($author->id);
        if (!$author) {
            return redirect('/authors')->with('errors', 'Author not found!');
        }

        return view('authors.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required | string | max:255',
            'born_date' => 'required | date',
            'biography' => 'required | string',
        ]);

        if ($validator->fails()) {
            return view('authors.edit',compact('author'))->with('errors', $validator->errors());
        }

        $authors = Author::find($author->id);
        if (!$authors) {
            return redirect('authors.edit',compact('author'))->with('errors', 'Author not found!');
        }

        $authors->fullname = $request->fullname;
        $authors->born_date = Carbon::parse($request->born_date)->format('Y-m-d');
        $authors->email = $request->email;
        $authors->biography = $request->biography;
        $authors->awards = $request->awards;
        $authors->published_books = $request->published_books;
        $authors->active = $request->active;
        
        if (!$authors->save()) {
            return view('authors.edit')->with('errors', 'Author not saved!');
        }

        return redirect('/authors')->with('success', 'Author updated!');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        $author = Author::findOrfail($author->id);
        if (!$author) {
            return redirect('/authors')->with('errors', 'Author not found!');
        }

        if (!$author->delete()) {
            return redirect('/authors')->with('errors', 'Author not deleted!');
        }

        return redirect('/authors')->with('success', 'Author deleted!');
    }
}
