@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <h2>Create Author</h2>
    </div>
    <form action="{{ route('authors.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-5">
                <label for="fullname">Full Name</label>
                <input type="text" class="form-control" id="fullname" name="fullname" value="{{ old('fullname') }}">
                @if ($errors->has('fullname'))
                    <div class="alert alert-danger mt-2">{{ $errors->first('fullname') }}</div>
                @endif
            </div>
            <div class="col-md-4">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                @if ($errors->has('email'))
                    <div class="alert alert-danger mt-2">{{ $errors->first('email') }}</div>
                @endif
            </div>
            <div class="col-md-3">
                <label for="born_date">Born Date</label>
                <input type="date" class="form-control" id="born_date" name="born_date" value="{{ old('born_date') }}">
                @if ($errors->has('born_date'))
                    <div class="alert alert-danger mt-2">{{ $errors->first('born_date') }}</div>
                @endif
            </div>
            <div class="col-md-12">
                <label for="biography">Biopgraphy</label>
                <textarea class="form-control" name="biography" id="biography" cols="30" rows="10"></textarea>
                @if ($errors->has('biography'))
                    <div class="alert alert-danger mt-2">{{ $errors->first('biography') }}</div>
                @endif
            </div>
            <div class="col-md-12">
                <label for="awards">Awards</label>
                <textarea class="form-control" name="awards" id="awards" cols="15" rows="10"></textarea>
                @if ($errors->has('awards'))
                    <div class="alert alert-danger mt-2">{{ $errors->first('awards') }}</div>
                @endif
            </div>
            <div class="col-md-12">
                <label for="published_books">Published Books</label>
                <textarea class="form-control" name="published_books" id="published_books" cols="15" rows="10"></textarea>
                @if ($errors->has('published_books'))
                    <div class="alert alert-danger mt-2">{{ $errors->first('published_books') }}</div>
                @endif
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary" >Create</button>
    </form>
</div>

@endsection