@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Authors</h2>
                <a href="{{ route('authors.create') }}" class="btn btn-success my-3">Create Author</a>
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
                            <td>Full Name</td>
                            <td>Born Date</td>
                            <td>Email</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($authors as $author)
                        <tr>
                            <td>{{$author->id}}</td>
                            <td>{{$author->fullname}}</td>
                            <td>{{$author->born_date}}</td>
                            <td>{{$author->email}}</td>
                            <td style="display: flex;">
                                @if (Auth::user()->hasRole('librarian') || Auth::user()->can('show author'))
                                    <a href="{{ route('authors.show',$author->id)}}" class="btn btn-primary btn-sm" style="margin-right: 5px"><i class="fas fa-eye"></i></a>
                                @endif
                                @if (Auth::user()->hasRole('librarian') || Auth::user()->can('edit author'))
                                    <a href="{{ route('authors.edit',$author->id)}}" class="btn btn-warning btn-sm" style="margin-right: 5px"><i class="fas fa-edit"></i></a>
                                @endif
                                @if (Auth::user()->hasRole('librarian') || Auth::user()->can('delete author'))
                                    <form action="{{ route('authors.destroy', $author->id)}}" method="post">
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