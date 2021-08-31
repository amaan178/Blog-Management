@foreach ($comments as $comment)
    <div class="display-comment ml30">
        <img src="{{ $comment->user->gravatar_image }}" alt="image" width="25px" class="img-circle">
        <span class=""><strong>{{ $comment->user->name }}</strong></span>
        <p class="m0">{{ $comment->comments }}</p>
        <a href="" id="reply"></a>
        <form method="post" action="{{ route('posts.comments.replies', [$post->id, $comment->id]) }}">
            @csrf
            <div class="form-group">
                <input type="text" name="comment_body" class="form-control" />
                <input type="hidden" name="post_id" value="{{ $post->id }}" />
                <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-success" value="Reply" />
            </div>
        </form>
        @include('blogs.partials._comment', ['comments' => $comment->getReplies()])
    </div>
@endforeach
