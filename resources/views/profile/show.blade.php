@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron text-center mb-0">
                    <img src="{{ asset('storage/avatars/default/boy.png') }}" width="125px" class="avatar profile-avatar" alt="">
                    @if($user->isMe())
                        <h4><span class="label label-default">That's you</span></h4>
                    @endif
                    @if($fullname = $user->profile->getFullName())
                        <h1>{{ $fullname }}</h1>
                        <p>{{ '@' . $user->username }}</p>
                    @else
                        <h1>{{ '@' . $user->username }}</h1>
                    @endif
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="pull-left">
                            <a href="" class="btn btn-link"><strong>Following: {{ $user->following->count() }}</strong></a>
                            <a href="" class="btn btn-link"><strong>Followers: {{ $user->followers->count() }}</strong></a>
                        </div>
                        <div class="pull-right">
                            @if (!$user->isMe())
                                @if($user->isFollowed)
                                    <a class="btn btn-danger" href="{{ route('unfollow', $user->id) }}">Unfollow</a>
                                @else
                                    <a class="btn btn-primary" href="{{ route('follow', $user->id) }}">Follow</a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Foobar panel</div>
                    <div class="panel-body">

                    </div>
                </div>
            </div>
            <div class="col-md-6">
               <posts inline-template>
                   <div class="panel panel-default">
                       <div class="panel-heading"><a href="" class="btn btn-link"><strong>Posts: {{ $posts->total()  }}</strong></a></div>
                       <div class="panel-body">
                           @if($user->isMe())
                               <new-post @posted="add"></new-post>
                           @endif
                           <ul class="media-list">
                               <div v-for="post in posts" :key="post.id">
                                <hr>
                                <post :item="post"></post>
                            </div>
                            <delete-post @deleted="remove" :post-item="modalDelete"></delete-post>
                               {{--@forelse($posts as $post)--}}
                                   {{--<hr>--}}
                                   {{--@include('posts._post')--}}
                               {{--@empty--}}
                                   {{--<p>There are no posts by this user.</p>--}}
                               {{--@endforelse--}}
                           </ul>
                       </div>
                   </div>
               </posts>
                {{--<div class="text-center mt-0">--}}
                {{--{{ $posts->links() }}--}}
                {{--</div>--}}
            </div>
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Foobar panel</div>
                    <div class="panel-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
