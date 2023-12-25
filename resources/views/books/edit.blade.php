@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <h2>Edit Book</h2>
        </div>
        
        <form action="{{ route('books.update', $books->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-md-6">
                    <label for="isbn">ISBN</label>
                    <input type="text" class="form-control" id="isbn" name="isbn" value="{{ $books->isbn }}">
                    @if ($errors->has('isbn'))
                        <div class="alert alert-danger mt-2">{{ $errors->first('isbn') }}</div>
                    @endif
                </div>
                <div class="col-md-6">
                    <label for="title">Title</label>
                    <input type="title" class="form-control" id="title" name="title" value="{{ $books->title }}">
                    @if ($errors->has('title'))
                        <div class="alert alert-danger mt-2">{{ $errors->first('title') }}</div>
                    @endif
                </div>
                <div class="col-md-12">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" id="description" cols="15" rows="10">{{ $books->description }}</textarea>
                    @if ($errors->has('description'))
                        <div class="alert alert-danger mt-2">{{ $errors->first('description') }}</div>
                    @endif
                </div>
                <div class="col-md-4">
                    <label for="author_id">Author</label>
                    <select class="form-control" name="author_id" id="author_id">
                        <option value="">Select an author</option>
                        @foreach ($authors as $author)
                            <option value="{{ $author->id }}" {{ ($books->author_id == $author->id) ? 'selected' : '' }}>{{ $author->fullname }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('author_id'))
                        <div class="alert alert-danger mt-2">{{ $errors->first('author_id') }}</div>
                    @endif
                </div>
                <div class="col-md-4">
                    <label for="genre">Genre</label>
                    <select class="form-control" name="genre_id" id="genre_id">
                        <option value="">Select a genre</option>
                        @foreach ($genres as $genre)
                            <option value="{{ $genre->id }}" {{ ($books->genre_id == $genre->id) ? 'selected' : '' }}>{{ $genre->description }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('genre'))
                        <div class="alert alert-danger mt-2">{{ $errors->first('genre') }}</div>
                    @endif
                </div>
                <div class="col-md-4">
                    <label for="category">Category</label>
                    <select class="form-control" name="category_id" id="category_id">
                        <option value="">Select a category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ ($books->category_id == $category->id) ? 'selected' : '' }}>{{ $category->description }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('category_id'))
                        <div class="alert alert-danger mt-2">{{ $errors->first('category_id') }}</div>
                    @endif
                </div>
                <div class="col-md-2">
                    <label for="total_copies">Total Copies</label>
                    <input type="number" class="form-control" id="total_copies" name="total_copies" value="{{ $books->total_copies }}">
                    @if ($errors->has('total_copies'))
                        <div class="alert alert-danger mt-2">{{ $errors->first('total_copies') }}</div>
                    @endif
                </div>
                <div class="col-md-2">
                    <label for="available_copies">Available Copies</label>
                    <input type="number" class="form-control" id="available_copies" name="available_copies" value="{{ $books->available_copies }}">
                    @if ($errors->has('available_copies'))
                        <div class="alert alert-danger mt-2">{{ $errors->first('available_copies') }}</div>
                    @endif
                </div>
                <div class="col-md-3">
                    <label for="published_at">Published At</label>
                    <input type="date" class="form-control" id="published_at" name="published_at" value="{{ \Illuminate\Support\Carbon::parse($books->published_at)->format('Y-m-d') }}">
                    @if ($errors->has('published_at'))
                        <div class="alert alert-danger mt-2">{{ $errors->first('published_at') }}</div>
                    @endif
                </div>
                <div class="col-md-3">
                    <label for="format">Book's Format</label>
                    <select class="form-control" name="format" id="format">
                        <option value="">Select a format</option>
                        <option value="Paperback" {{ $books->format ? 'selected' : '' }}>Paperback</option>
                        <option value="Hardcover" {{ $books->format ? 'selected' : '' }}>Hardcover</option>
                    </select>
                    @if ($errors->has('format'))
                        <div class="alert alert-danger mt-2">{{ $errors->first('format') }}</div>
                    @endif
                </div>
                <div class="col-md-2">
                    <label for="pages">Pages</label>
                    <input type="number" class="form-control" id="pages" name="pages" value="{{ $books->pages }}">
                    @if ($errors->has('pages'))
                        <div class="alert alert-danger mt-2">{{ $errors->first('pages') }}</div>
                    @endif
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection