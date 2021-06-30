@extends('layouts.admin-panel.app')

@section('content')
<div class="d-flex justify-content-end mb-3">
    <a href="{{route('posts.create')}}" class="btn btn-outline-primary">Add Post</a>
</div>
<div class="card">
    <div class="card-header">
        <h2>Posts</h2>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Title</th>
                    <th scope="col">Excerpt</th>
                    <th scope="col">Category</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td><img src="{{ $post->image_path }}" width="120"></td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->excerpt }}</td>
                    <td>{{ $post->category->name }}</td>
                    <td>
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                    data-target="#deleteModal" onclick="displayModal({{ $post->id }})">Delete
                        </button>
                    <td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="modal fade" id = "deleteModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="" id="deletePost" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            Are you sure you want to delete?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-outline-danger">Delete Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mt-5">
    {{ $posts->links('vendor.pagination.bootstrap-4') }}
</div>
@endsection

@section('page-level-scripts')
    <script>
        function displayModal(postId) {
            var url = "/posts/" + postId;
            $("#deletePost").attr('action', url);
        }
    </script>
@endsection
