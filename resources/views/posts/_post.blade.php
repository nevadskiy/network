<li class="media">
    <div class="media-left">
        <a href="#">
            <img alt="64x64" class="media-object" style="width: 64px; height: 64px;" src="{{ asset('storage/avatars/default/boy.png') }}" data-holder-rendered="true">
        </a>
    </div>
    <div class="media-body">
        <h4 class="media-heading clearfix">
            <div class="pull-left">
                {{ $post->author->username }}
                <small>{{ $post->created_at->diffForHumans() }}</small>
            </div>
            <div class="pull-right">
                @if($post->isLiked)
                    <a href="{{ route('post.unlike', $post->id) }}" class="btn btn-danger noutline mr-1"><span class="glyphicon glyphicon-heart"></span> {{ $post->likes_count ?: '' }}</a>
                @else
                    <a href="{{ route('post.like', $post->id) }}" class="btn btn-default noutline mr-1"><span class="glyphicon glyphicon-heart"></span> {{ $post->likes_count ?: '' }}</a>
                @endif
            </div>
        </h4>
        <p>{{ $post->body }}</p>
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