@extends('layouts.admin-panel.app')

@section('page-level-styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/solid.min.css"/>
@endsection

@section('content')
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('posts.create') }}" class="btn btn-outline-primary">Add Post</a>
    </div>
    <div class="card">
        <div class="card-header m-0">
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
                        @if (auth()->user()->isAdmin())
                            <th scope="col">Admin Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td><img src="{{ $post->image_path }}" width="140" alt=""></td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->excerpt }}</td>
                            <td>{{ $post->category->name }}</td>
                            <td>
                                <div class="mb-2">
                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-primary">
                                        Edit
                                    </a>
                                </div>
                                <div class="mb-2">
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                        data-target="#deleteModal" onclick="displayModal({{ $post->id }})">Delete
                                    </button>
                                </div>
                                <div class="mb-2">
                                    <form action="{{ route('posts.draft-post', $post->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-outline-warning">Draft</button>
                                    </form>
                                </div>
                            </td>
                            @if (auth()->user()->isAdmin())
                                <td>
                                    <form action="{{ route('posts.reason', $post->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-times"></i>
                                            Disapprove Post
                                        </button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id="deletepost" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        Are you sure you want to delete this post?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-danger">Delelte Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="mt-4">
        {{ $posts->links('vendor.pagination.bootstrap-4') }}
    </div>
@endsection

@section('page-level-scripts')
    <script>
        function displayModal(postId) {
            var url = "/posts/trash/" + postId;
            $("#deletepost").attr('action', url);
        }
    </script>
@endsection
