@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <h2>Author Details</h2>
        </div>
        <div class="row">
            <div class="col-md-5">
                <label for="fullname">Full Name</label>
                <input type="text" class="form-control" id="fullname" name="fullname" value="{{ $author->fullname }}" disabled>
            </div>
            <div class="col-md-4">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $author->email }}" disabled>
            </div>
            <div class="col-md-3">
                <label for="born_date">Born Date</label>
                <input type="date" class="form-control" id="born_date" name="born_date" value="{{ $author->born_date }}" disabled>
            </div>
            <div class="col-md-12">
                <label for="biography">Biopgraphy</label>
                <textarea class="form-control" name="biography" id="biography" cols="30" rows="10" disabled>{{ $author->biography }}</textarea>
            </div>
            <div class="form-group">
                <label for="awards">Awards</label>
                <textarea class="form-control" name="awards" id="awards" cols="15" rows="10" disabled>{{ $author->awards }}</textarea>
            </div>
            <div class="form-group">
                <label for="published_books">Published Books</label>
                <textarea class="form-control" name="published_books" id="published_books" cols="15" rows="10" disabled>{{ $author->published_books }}</textarea>
            </div>
        </div>
    </div>
@endsection