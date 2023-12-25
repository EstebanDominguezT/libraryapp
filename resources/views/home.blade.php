@extends('layouts.app')  {{-- Assuming you have a layout file --}}

@section('content')
    @if (auth()->user()->hasRole('librarian'))
        @include('layouts.librarian')
    @else
        @include('layouts.member')
    @endif
@endsection