@extends('layouts.app')
@section('header')
    <style>
        .my-read-only-class 
        {   
            cursor: not-allowed;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div>
            <h2>Edit Borrow</h2>
        </div>
        
        <form action="{{ route('borrows.update', $borrows->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-md-6">
                    <label for="book">Book</label>
                    <select class="form-control my-read-only-class" name="book_id" id="book_id">
                        <option value="">Select a book</option>
                        @foreach ($books as $book)
                            <option value="{{ $book->id }}" {{ ($borrows->book_id == $book->id) ? 'selected' : '' }}>{{ $book->isbn }} - {{ $book->title }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('book_id'))
                        <div class="alert alert-danger mt-2">{{ $errors->first('book_id') }}</div>
                    @endif
                </div>
                <div class="col-md-6">
                    <label for="user_id">Member</label>
                    <select class="form-control" name="user_id" id="user_id">
                        <option value="">Select a user</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ ($borrows->user_id == $user->id) ? 'selected' : '' }}>{{ $user->fullname }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('user_id'))
                        <div class="alert alert-danger mt-2">{{ $errors->first('user_id') }}</div>
                    @endif
                </div>
                <div class="col-md-3">
                    <label for="borrowed_at">Borrow Date</label>
                    <input type="date" class="form-control" name="borrowed_at" id="borrowed_at" value="{{ \Illuminate\Support\Carbon::parse($borrows->borrowed_at)->format('Y-m-d') }}" readonly>
                    @if ($errors->has('borrowed_at'))
                        <div class="alert alert-danger mt-2">{{ $errors->first('borrowed_at') }}</div>
                    @endif
                </div>
                <div class="col-md-3">
                    <label for="due_at">Due Date</label>
                    <input type="date" class="form-control" name="due_at" id="due_at" value="{{ \Illuminate\Support\Carbon::parse($borrows->due_at)->format('Y-m-d') }}">
                    @if ($errors->has('due_at'))
                        <div class="alert alert-danger mt-2">{{ $errors->first('due_at') }}</div>
                    @endif
                </div>
                <div class="col-md-3">
                    <label for="returned_at">Returned Date</label>
                    <input type="date" class="form-control" name="returned_at" id="returned_at" value="{{ \Illuminate\Support\Carbon::parse($borrows->returned_at)->format('Y-m-d') }}">
                    @if ($errors->has('returned_at'))
                        <div class="alert alert-danger mt-2">{{ $errors->first('returned_at') }}</div>
                    @endif
                </div>
                <div class="col-md-3">
                    <label for="status">Status</label>
                    <select class="form-control" name="status" id="status">
                        <option value="">Select a status</option>
                        <option value="borrowed" {{ $borrows->status == 'borrowed' ? 'selected' : '' }}>Borrowed</option>
                        <option value="returned" {{ $borrows->status == 'returned' ? 'selected' : '' }}>Returned</option>
                    </select>
                    @if ($errors->has('status'))
                        <div class="alert alert-danger mt-2">{{ $errors->first('status') }}</div>
                    @endif
                </div>
                <div class="col-md-6">
                    <label for="user_returned_id">Returned User</label>
                    <select class="form-control" name="user_returned_id" id="user_returned_id">
                        <option value="">Select a user</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ $borrows->user_returned_id ? 'selected' : '' }}>{{ $user->fullname }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('user_returned_id'))
                        <div class="alert alert-danger mt-2">{{ $errors->first('user_returned_id') }}</div>
                    @endif
                </div>
                <div class="col-md-12">
                    <label for="notes">Returned Notes</label>
                    <textarea class="form-control" name="notes" id="notes" cols="30" rows="10">{{ $borrows->notes }}</textarea>
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection