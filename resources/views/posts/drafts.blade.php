@extends('layouts.admin-panel.app')

@section('content')
    <div class="card">
        <div class="card-header m-0">
            <h2>Drafts</h2>
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
                            <td><img src="{{ asset($post->image_path) }}" width="140" alt=""></td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->excerpt }}</td>
                            <td>{{ $post->category->name }}</td>
                            <td><a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-outline-primary">
                                    Edit</a>
                                <form action="{{ route('posts.publish-draft', $post->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-outline-success">Publish Post</button>
                                </form>
                                <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal"
                                    data-target="#deleteModal" onclick="displayModal({{ $post->id }})">Trash
                                </button>
                            </td>
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
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id="deletepost" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        Are you sure you want to trash this post?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-danger">Trash Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{ $posts->links('') }}
@endsection

@section('page-level-scripts')
    <script>
        function displayModal(postId) {
            var url = "/posts/trash/" + postId;
            $("#deletepost").attr('action', url);
        }
    </script>
@endsection
