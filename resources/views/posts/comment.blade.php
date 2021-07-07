@extends('layouts.admin-panel.app')

@section('page-level-styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/fontawesome.min.css" integrity="sha512-OdEXQYCOldjqUEsuMKsZRj93Ht23QRlhIb8E/X0sbwZhme8eUw6g8q7AdxGJKakcBbv7+/PX0Gc2btf7Ru8cZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/solid.min.css" integrity="sha512-jQqzj2vHVxA/yCojT8pVZjKGOe9UmoYvnOuM/2sQ110vxiajBU+4WkyRs1ODMmd4AfntwUEV4J+VfM6DkfjLRg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

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
                        <th scope="col">User Name</th>
                        <th scope="col">Post Title</th>
                        <th scope="col">Comments</th>
                        @if(auth()->user()->isAdmin())
                            <th scope="col">Admin Controls</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comments as $comment)
                    <tr>
                        <td>{{ $comment->user->name }}</td>
                        <td>{{ $comment->post->title }}</td>
                        <td>{{ $comment->comments }}</td>
                        @if(auth()->user()->isAdmin())
                            <td>
                                @if (!($comment->isApproved()))
                                    <form action="{{route('comment.approve-comment', $comment->id)}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-outline-success">
                                            <i class="fas fa-check"></i>
                                            Approve Comment
                                        </button>
                                    </form>
                                @else
                                    <form action="{{route('comment.disapprove-comment', $comment->id)}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-times"></i>
                                            Disapprove Comment
                                        </button>
                                    </form>
                                @endif
                            </td>
                        @endif
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
            <div class="modal fade" id = "draftModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="" id="draftPost" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body">
                                Are you sure you want to draft this Post?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-outline-danger">Draft Post</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5">
        {{ $comments->links('vendor.pagination.bootstrap-4') }}
    </div>
@endsection

@section('page-level-scripts')
    <script>
        function displayModal(postId) {
            var url = "/posts/trash/" + postId;
            $("#deletePost").attr('action', url);
        }
    </script>

    <script>
        function displayDraftModal(postId) {
            var url = "/posts/draft/" + postId;
            $("#draftPost").attr('action', url);
        }
    </script>
@endsection
