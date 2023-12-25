@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Genres</h2>
                <a href="{{ route('genres.create') }}" class="btn btn-success my-3">Create Genre</a>
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
                            <td>Description</td>
                            <td> Active </td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($genres as $genre)
                        <tr>
                            <td>{{$genre->id}}</td>
                            <td>{{$genre->description}}</td>
                            <td><input type="checkbox" id="active" name="active" value="{{$genre->active}}" {{ ($genre->active == true) ? 'checked' : '' }}></td>
                            <td style="display: flex;">
                                @if (Auth::user()->hasRole('librarian') || Auth::user()->can('show genre'))
                                    <a href="{{ route('genres.show',$genre->id)}}" class="btn btn-primary btn-sm" style="margin-right: 5px"><i class="fas fa-eye"></i></a>
                                @endif
                                @if (Auth::user()->hasRole('librarian') || Auth::user()->can('edit genre'))
                                    <a href="{{ route('genres.edit',$genre->id)}}" class="btn btn-warning btn-sm" style="margin-right: 5px"><i class="fas fa-edit"></i></a>
                                @endif
                                @if (Auth::user()->hasRole('librarian') || Auth::user()->can('delete genre'))
                                    <form action="{{ route('genres.destroy', $genre->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit" style="margin-right: 5px"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                @endif
                            </td>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection