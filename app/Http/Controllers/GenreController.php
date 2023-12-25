<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genres = Genre::all();
        return view('genres.index', compact('genres'));
    }

    public function create()
    {
        return view('genres.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required | string | max:255',
            'active' => 'required | boolean'
        ]);

        if ($validator->fails()) {
            return view('genres.create')->with('errors', $validator->errors());
        }

        $genres = new Genre();
        $genres->description = $request->description;
        $genres->active = true;
        
        if (!$genres->save()) {
            return view('genres.create')->with('errors', 'Genre not saved!');
        }
        
        return redirect('/genres')->with('success', 'Genre saved!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Genre $genre)
    {
        $genres = genre::find($genre->id);
        if (!$genres) {
            return redirect('/genres')->with('errors', 'Genre not found!');
        }

        return view('genres.show', compact('genres'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genre $genre)
    {
        $genres = genre::find($genre->id);
        if (!$genre) {
            return redirect('/genres')->with('errors', 'Genre not found!');
        }

        return view('genres.edit', compact('genres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Genre $genre)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required | string | max:255',
            'active' => 'required | boolean'
        ]);

        if ($validator->fails()) {
            return view('genres.edit',compact('genre'))->with('errors', $validator->errors());
        }

        $genres = Genre::find($genre->id);
        if (!$genres) {
            return redirect('genres.edit',compact('genre'))->with('errors', 'Genre not found!');
        }

        $genres->description = $request->description;
        $genres->active = $request->active;
        
        if (!$genres->save()) {
            return view('genres.edit')->with('errors', 'Genre not saved!');
        }

        return redirect('/genres')->with('success', 'Genre updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre)
    {
        $genre = genre::findOrfail($genre->id);
        if (!$genre) {
            return redirect('/genres')->with('errors', 'Genres not found!');
        }

        if (!$genre->delete()) {
            return redirect('/genres')->with('errors', 'Genres not deleted!');
        }

        return redirect('/genres')->with('success', 'Genres deleted!');
    }
}
