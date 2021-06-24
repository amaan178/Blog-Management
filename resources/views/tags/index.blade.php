@extends('layouts.admin-panel.app')

@section('content')
<div class="d-flex justify-content-end mb-3">
    <a href="{{route('tags.create')}}" class="btn btn-outline-primary">Add Tag</a>
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
                @foreach ($tags as $tag)
                <tr>
                    <td>{{ $tag->name }}</td>
                    <td>
                        <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                    data-target="#deleteModal" onclick="displayModal({{ $tag->id }})">Delete
                        </button>
                    <td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="modal fade" id = "deleteModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="" id="deleteTag" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            Are you sure you want to delete?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-outline-danger">Delete Tag</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mt-5">
    {{ $tags->links('vendor.pagination.bootstrap-4') }}
</div>
@endsection

@section('page-level-scripts')
    <script>
        function displayModal(tagId) {
            var url = "/tags/" + tagId;
            $("#deleteTag").attr('action', url);
        }
    </script>
@endsection
