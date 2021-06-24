@extends('layouts.admin-panel.app')

@section('content')
<div class="d-flex justify-content-end mb-3">
    <a href="{{route('categories.create')}}" class="btn btn-outline-primary">Add Category</a>
</div>
<div class="card">
    <div class="card-header">
        <h2>Card Title</h2>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                    data-target="#deleteModal" onclick="displayModal({{ $category->id }})">Delete
                        </button>
                    <td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="modal fade" id = "deleteModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="" id="deleteCategory" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            Are you sure you want to delete?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-outline-danger">Delete Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mt-5">
    {{ $categories->links('vendor.pagination.bootstrap-4') }}
</div>
@endsection

@section('page-level-scripts')
    <script>
        function displayModal(categoryId) {
            var url = "/categories/" + categoryId;
            $("#deleteCategory").attr('action', url);
        }
    </script>
@endsection
