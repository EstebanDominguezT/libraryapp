@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Books</h2>
                <a href="{{ route('books.create') }}" class="btn btn-success my-3">Create Book</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @if(session()->get('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div><br/>
                @endif
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>ISBN</td>
                            <td>Title</td>
                            <td>Author</td>
                            <td>Genre</td>
                            <td>Category</td>
                            <td>Total Copies</td>
                            <td>Available Copies</td>
                            <td>Active</td>
                            <td >Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                        <tr>
                            <td>{{$book->id}}</td>
                            <td>{{$book->isbn}}</td>
                            <td>{{$book->title}}</td>
                            <td>{{$book->author_name}}</td>
                            <td>{{$book->genre_description}}</td>
                            <td>{{$book->category_description}}</td>
                            <td>{{$book->total_copies}}</td>
                            <td>{{$book->available_copies}}</td>
                            <td><input type="checkbox" id="active" name="active" value="{{$book->active}}" {{ ($book->active == true) ? 'checked' : '' }}></td>
                            <td style="display: flex;">
                                @if (Auth::user()->hasRole('librarian') || Auth::user()->can('edit book'))
                                <a href="{{ route('books.show',$book->id)}}" class="btn btn-primary btn-sm" style="margin-right: 5px"><i class="fas fa-eye"></i></a>
                                @endif
                                @if (Auth::user()->hasRole('librarian') || Auth::user()->can('show book'))
                                <a href="{{ route('books.edit',$book->id)}}" class="btn btn-warning btn-sm" style="margin-right: 5px"><i class="fas fa-edit"></i></a>
                                @endif
                                @if (Auth::user()->hasRole('librarian') || Auth::user()->can('delete book'))
                                    <form action="{{ route('books.destroy', $book->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit" style="margin-right: 5px"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection