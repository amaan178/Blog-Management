@extends('layouts.admin-panel.app')

@section('content')
<div class="card">
        <div class="card-header"><h2>Update Category</h2></div>
        <div class="card-body">
            <form action="{{route('tags.update', $tag->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text"
                           class="form-control" @error('name') is-invalid @enderror
                           id="name"
                           value="{{ old('name', $tag->name) }}"
                           placeholder="Enter Category Name"
                           name="name" >
                    @error('name')
                        <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-outline-warning">Edit Tag</button>
            </form>
        </div>
    </div>
@endsection
