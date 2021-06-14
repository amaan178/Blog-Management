@extends('layouts.admin-panel.app')

@section('content')
    <div class="d-flex justify-content-end mb-3">
        <a href="{{route('categories.create')}}" class="btn btn-outline-primary">Add Category</a>
    </div>
    <div class="card">
        <div class="card-header"><h2>Card Title</h2></div>
        <div class="card-body">
            This is some text within a card body
        </div>
    </div>
@endsection
