@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <h2>Edit Author</h2>
        </div>
        
        <form action="{{ route('authors.update', $author->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-md-5">
                    <label for="fullname">Full Name</label>
                    <input type="text" class="form-control" id="fullname" name="fullname" value="{{ $author->fullname }}">
                    @if ($errors->has('fullname'))
                        <div class="alert alert-danger mt-2">{{ $errors->first('fullname') }}</div>
                    @endif
                </div>
                <div class="col-md-4">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $author->email }}">
                    @if ($errors->has('email'))
                        <div class="alert alert-danger mt-2">{{ $errors->first('email') }}</div>
                    @endif
                </div>
                <div class="col-md-3">
                    <label for="born_date">Born Date</label>
                    <input type="date" class="form-control" id="born_date" name="born_date" value="{{ \Illuminate\Support\Carbon::parse($author->born_date)->format('Y-m-d') }}">
                    @if ($errors->has('born_date'))
                        <div class="alert alert-danger mt-2">{{ $errors->first('born_date') }}</div>
                    @endif
                </div>
                <div class="col-md-12">
                    <label for="biography">Biopgraphy</label>
                    <textarea class="form-control" name="biography" id="biography" cols="30" rows="10">{{ $author->biography }}</textarea>
                    @if ($errors->has('biography'))
                        <div class="alert alert-danger mt-2">{{ $errors->first('biography') }}</div>
                    @endif
                </div>
                <div class="col-md-2">
                    <label for="active">Active</label>
                    <select name="active" id="active" class="form-control">
                        <option value="1" {{ $author->active ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ !$author->active ? 'selected' : '' }}>No</option>
                    </select>
                    @if ($errors->has('active'))
                        <div class="alert alert-danger mt-2">{{ $errors->first('active') }}</div>
                    @endif
                </div>
                <div class="col-md-12">
                    <label for="awards">Awards</label>
                    <textarea class="form-control" name="awards" id="awards" cols="15" rows="10">{{ $author->awards }}</textarea>
                    @if ($errors->has('awards'))
                        <div class="alert alert-danger mt-2">{{ $errors->first('awards') }}</div>
                    @endif
                </div>
                <div class="col-md-12">
                    <label for="published_books">Published Books</label>
                    <textarea class="form-control" name="published_books" id="published_books" cols="15" rows="10">{{ $author->published_books }}</textarea>
                    @if ($errors->has('published_books'))
                        <div class="alert alert-danger mt-2">{{ $errors->first('published_books') }}</div>
                    @endif
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection