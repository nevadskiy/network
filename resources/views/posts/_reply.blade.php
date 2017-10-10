<div class="media">
    <div class="media-left">
        <a href="#">
            <img alt="64x64" class="media-object" style="width: 64px; height: 64px;" src="{{ asset('storage/avatars/default/boy.png') }}" data-holder-rendered="true">
        </a>
    </div>
    <div class="media-body">
        <h4 class="media-heading clearfix">
            <div class="pull-left">
                {{ $reply->author->username }}
                <small>{{ $reply->created_at->diffForHumans() }}</small>
            </div>
            <div class="pull-right"><button class="btn btn-default noutline mr-1"><span class="glyphicon glyphicon-heart"></span> 25</button></div>
        </h4>
        <p>{{ $reply->body }}</p>
    </div>
</div>