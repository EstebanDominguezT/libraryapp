@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Categories</h2>
                <a href="{{ route('categories.create') }}" class="btn btn-success my-3">Create Category</a>
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
                        @foreach($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->description}}</td>
                            <td><input type="checkbox" id="active" name="active" value="{{$category->active}}" {{ ($category->active == true) ? 'checked' : '' }}></td>
                            <td style="display: flex;">
                                @if (Auth::user()->hasRole('librarian') || Auth::user()->can('edit category'))
                                <a href="{{ route('categories.show',$category->id)}}" class="btn btn-primary btn-sm" style="margin-right: 5px"><i class="fas fa-eye"></i></a>
                                @endif
                                @if (Auth::user()->hasRole('librarian') || Auth::user()->can('show category'))
                                    <a href="{{ route('categories.edit',$category->id)}}" class="btn btn-warning btn-sm" style="margin-right: 5px"><i class="fas fa-edit"></i></a>
                                @endif
                                @if (Auth::user()->hasRole('librarian') || Auth::user()->can('delete category'))
                                    <form action="{{ route('categories.destroy', $category->id)}}" method="post">
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