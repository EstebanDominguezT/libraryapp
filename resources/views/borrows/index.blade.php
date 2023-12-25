@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Borrows</h2>
                <a href="{{ route('borrows.create') }}" class="btn btn-success my-3">Create Borrow</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @if (session()->get('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div><br />
                @endif
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Title</td>
                            <td>User</td>
                            <td>Borrowed At</td>
                            <td>Due At</td>
                            <td>Status</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($borrows as $borrow)
                            <tr>
                                <td>{{ $borrow->id }}</td>
                                <td>{{ $borrow->book_isbn }} - {{ $borrow->book_title }}</td>
                                <td>{{ $borrow->user_id }} - {{ $borrow->user_fullname }}</td>
                                <td>{{ $borrow->borrowed_at }}</td>
                                <td>{{ $borrow->due_at }}</td>
                                <td>{{ $borrow->status }}</td>
                                <td style="display: flex;">
                                    @if (Auth::user()->hasRole('librarian') || Auth::user()->can('show borrow'))
                                        <a href="{{ route('borrows.show',$borrow->id)}}" class="btn btn-primary btn-sm" style="margin-right: 5px"><i class="fas fa-eye"></i></a>
                                    @endif
                                    @if (Auth::user()->hasRole('librarian') || Auth::user()->can('edit borrow'))
                                    <a href="{{ route('borrows.edit',$borrow->id)}}" class="btn btn-warning btn-sm" style="margin-right: 5px"><i class="fas fa-edit"></i></a>
                                    @endif
                                    @if (Auth::user()->hasRole('librarian') || Auth::user()->can('delete borrow'))
                                        <form action="{{ route('borrows.destroy', $borrow->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" type="submit" style="margin-right: 5px"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
