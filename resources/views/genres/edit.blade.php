@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <h2>Edit Genre</h2>
        </div>
        
        <form action="{{ route('genres.update', $genres->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-md-5">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" name="description" value="{{ $genres->description }}">
                    @if ($errors->has('description'))
                        <div class="alert alert-danger mt-2">{{ $errors->first('description') }}</div>
                    @endif
                </div>
                <div class="col-md-2">
                    <label for="active">Active</label>
                    <select name="active" id="active" class="form-control">
                        <option value="1" {{ $genres->active ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ !$genres->active ? 'selected' : '' }}>No</option>
                    </select>
                    @if ($errors->has('active'))
                        <div class="alert alert-danger mt-2">{{ $errors->first('active') }}</div>
                    @endif
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection