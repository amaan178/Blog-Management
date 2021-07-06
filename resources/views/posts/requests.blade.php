@extends('layouts.admin-panel.app')

@section('page-level-styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/solid.min.css"/>
@endsection

@section('content')
    <div class="card">
        <div class="card-header m-0">
            <h2>Disapproved Posts</h2>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Title</th>
                        <th scope="col">Excerpt</th>
                        <th scope="col">Category</th>
                        <th scope="col">Reason for disapproval</th>
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
                            <td>{{ $post->reason }}</td>
                            <td>
                                <form action="{{ route('posts.approve-request', $post->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-outline-success">
                                        <i class="fas fa-check"></i>
                                        Approve Post
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
