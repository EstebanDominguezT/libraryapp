@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <h2>Genre Details</h2>
        </div>
        <div class="row">
            <div class="col-md-5">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description" value="{{ $genres->description }}" disabled>
            </div>
            <div class="col-md-2">
                <label for="active">Active</label>
                <select name="active" id="active" class="form-control" disabled>
                    <option value="1" {{ $genres->active ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ !$genres->active ? 'selected' : '' }}>No</option>
                </select>
                @if ($errors->has('active'))
                    <div class="alert alert-danger mt-2">{{ $errors->first('active') }}</div>
                @endif
            </div>
        </div>
    </div>
@endsection