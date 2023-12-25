@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <h2>Create Borrow</h2>
    </div>
    <form action="{{ route('borrows.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <label for="book">Book</label>
                <select class="form-control" name="book_id" id="book_id">
                    <option value="">Select a book</option>
                    @foreach ($books as $book)
                        <option value="{{ $book->id }}">{{ $book->isbn }} - {{ $book->title }}</option>
                    @endforeach
                </select>
                @if ($errors->has('book_id'))
                    <div class="alert alert-danger mt-2">{{ $errors->first('book_id') }}</div>
                @endif
            </div>
            <div class="col-md-6">
                <label for="user">Member</label>
                <select class="form-control" name="user_id" id="user_id">
                    <option value="">Select a user</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->fullname }}</option>
                    @endforeach
                </select>
                @if ($errors->has('user_id'))
                    <div class="alert alert-danger mt-2">{{ $errors->first('user_id') }}</div>
                @endif
            </div>
            <div class="col-md-3">
                <label for="borrowed_at">Borrow Date</label>
                <input type="date" class="form-control" name="borrowed_at" id="borrowed_at" value="{{ \Illuminate\Support\Carbon::parse(old('borrowed_at'))->format('Y-m-d') }}">
                @if ($errors->has('borrowed_at'))
                    <div class="alert alert-danger mt-2">{{ $errors->first('borrowed_at') }}</div>
                @endif
            </div>
            <div class="col-md-3">
                <label for="due_at">Due Date</label>
                <input type="date" class="form-control" name="due_at" id="due_at" value="{{ \Illuminate\Support\Carbon::parse(old('due_at'))->addWeeks(2)->format('Y-m-d') }}" readonly>
                @if ($errors->has('due_at'))
                    <div class="alert alert-danger mt-2">{{ $errors->first('due_at') }}</div>
                @endif
            </div>
            <div class="col-md-3">
                <label for="status">Status</label>
                <input class="form-control" type="text" name="status" id="status" value="borrowed" readonly>
                @if ($errors->has('status'))
                    <div class="alert alert-danger mt-2">{{ $errors->first('status') }}</div>
                @endif
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary" >Create</button>
    </form>
</div>

@endsection