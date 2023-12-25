@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <h2>Borrow Details</h2>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for="borrow_id">Borrow ID</label>
                <input class="form-control" type="text" name="borrow_id" id="borrow_id" value="{{ $borrow->id }}" disabled>
            </div>
            <div class="col-md-6">
                <label for="book_id">Book</label>
                <input class="form-control" type="text" name="book_id" id="book_id" value="{{ $borrow->book_isbn }} - {{ $borrow->book_title }}" disabled>
            </div>
            <div class="col-md-2">
                <label for="borrowed_at">Borrow Date</label>
                <input class="form-control" type="date" name="borrowed_at" id="borrowed_at" value="{{ \Illuminate\Support\Carbon::parse($borrow->borrowed_at)->format('Y-m-d') }}" disabled>
            </div>
            <div class="col-md-2">
                <label for="due_at">Due Date</label>
                <input class="form-control" type="date" name="due_at" id="due_at" value="{{ \Illuminate\Support\Carbon::parse($borrow->due_at)->format('Y-m-d') }}" disabled>
            </div>
            <div class="col-md-4">
                <label for="user_id">Borrow Member</label>
                <input class="form-control" type="text" name="user_id" id="user_id" value="{{ $borrow->user_id }} - {{ $borrow->user_fullname }}" disabled>
            </div>
            <div class="col-md-2">
                <label for="returned_at">Returned Date</label>
                <input class="form-control" type="date" name="returned_at" id="returned_at" value="{{ \Illuminate\Support\Carbon::parse(old('returned_at'))->format('Y-m-d') }}" disabled>
            </div>
            <div class="col-md-4">
                <label for="user_returned_id">Returned User</label>
                <input class="form-control" type="text" name="user_returned_id" id="user_returned_id" value='{{ ($borrow->user_returned_id != null) ? $borrow->user_returned_id.' - '.$borrow->user_returned_fullname : "" }}' disabled>
            </div>
            <div class="col-md-12">
                <label for="user_returned_id">Returned Notes</label>
                <textarea class="form-control" name="notes" id="notes" cols="30" rows="10" disabled>{{ $borrow->notes }}</textarea>
            </div>
        </div>
    </div>
@endsection