@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <h2>Book Details</h2>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="isbn">ISBN</label>
                <input type="text" class="form-control" id="isbn" name="isbn" value="{{ $books->isbn }}" disabled>
            </div>
            <div class="col-md-6">
                <label for="title">Title</label>
                <input type="title" class="form-control" id="title" name="title" value="{{ $books->title }}" disabled>
            </div>
            <div class="col-md-12">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description" cols="15" rows="10" disabled>{{ $books->description }}</textarea>
            </div>
            <div class="col-md-4">
                <label for="author_id">Author</label>
                <select class="form-control" name="author_id" id="author_id" disabled>
                    <option value="">Select an author</option>
                    @foreach ($authors as $author)
                        <option value="{{ $author->id }}" {{ ($books->author_id == $author->id) ? 'selected' : '' }}>{{ $author->fullname }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="genre">Genre</label>
                <select class="form-control" name="genre_id" id="genre_id" disabled>
                    <option value="">Select a genre</option>
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}" {{ ($books->genre_id == $genre->id) ? 'selected' : '' }}>{{ $genre->description }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="category">Category</label>
                <select class="form-control" name="category_id" id="category_id" disabled>
                    <option value="">Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ ($books->category_id == $category->id) ? 'selected' : '' }}>{{ $category->description }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label for="total_copies">Total Copies</label>
                <input type="number" class="form-control" id="total_copies" name="total_copies" value="{{ $books->total_copies }}" disabled>
            </div>
            <div class="col-md-2">
                <label for="available_copies">Available Copies</label>
                <input type="number" class="form-control" id="available_copies" name="available_copies" value="{{ $books->available_copies }}" disabled>
            </div>
            <div class="col-md-3">
                <label for="published_at">Published At</label>
                <input type="date" class="form-control" id="published_at" name="published_at" value="{{ \Illuminate\Support\Carbon::parse($books->published_at)->format('Y-m-d') }}" disabled>
            </div>
            <div class="col-md-3">
                <label for="format">Book's Format</label>
                <select class="form-control" name="format" id="format" disabled>
                    <option value="">Select a format</option>
                    <option value="Paperback" {{ $books->format ? 'selected' : '' }}>Paperback</option>
                    <option value="Hardcover" {{ $books->format ? 'selected' : '' }}>Hardcover</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="pages">Pages</label>
                <input type="number" class="form-control" id="pages" name="pages" value="{{ $books->pages }}" disabled>
            </div>
        </div>
    </div>
@endsection