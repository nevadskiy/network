<li class="media">
    <div class="media-left">
        <a href="#">
            <img alt="64x64" class="media-object" style="width: 64px; height: 64px;" src="{{ asset('storage/avatars/default/boy.png') }}" data-holder-rendered="true">
        </a>
    </div>
    <div class="media-body">
        <div class="media-heading clearfix">
            <div class="pull-left">
                <h4>{{ $post->author->username }}
                <small>{{ $post->created_at->diffForHumans() }}</small>
                </h4>
            </div>
            <div class="pull-right">
{{--                <like url="{{ route('post.like', $post->id) }}" init-is-liked="{{ $post->isLiked }}" init-likes-count="{{ $post->likes_count }}"></like>--}}
            </div>
        </div>
        <p>{{ $post->body }}</p>
        <div class="clearfix">
            <div class="edits pull-right">
                <button class="btn btn-xs btn-primary">Reply</button>
                <button class="btn btn-xs btn-warning">Edit</button>
                <button class="btn btn-xs btn-danger">Delete</button>
            </div>
        </div>
        @if ($post->replies->count())
           <hr>
            @foreach($post->replies as $reply)
                @include('posts._reply')
            @endforeach
        @endif
        <div class="col-md-10">
            <form action="{{ route('reply.store', $post) }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="text" name="body" class="form-control" placeholder="You got something to say?">
                </div>
                <button class="btn btn-primary">Reply</button>
            </form>
        </div>
    </div>
</li>