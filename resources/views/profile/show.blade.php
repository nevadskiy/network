@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron text-center mb-0 text-white" style="background-image: url({{ asset('storage/background/default1.jpg') }})">
                    <img src="{{ $user->getAvatarUrl() }}" width="125px" class="avatar profile-avatar" alt="avatar">
                    @if($user->isMe())
                        <h4><span class="label label-default">That's you</span></h4>
                    @endif
                    @if($fullname = $user->profile->getFullName())
                        <h2>{{ $fullname }}</h2>
                        <p><strong>{{ '@' . $user->username }}</strong></p>
                    @else
                        <h2>{{ '@' . $user->username }}</h2>
                    @endif
                </div>

                <follows v-cloak inline-template init-following="{{ $user->following->count() }}" init-followers="{{ $user->followers->count() }}">
                    <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="pull-left">
                            <a href="{{ route('user.following', $user->id) }}" class="btn btn-link"><strong>Following: @{{ followingsCount }} </strong></a>
                            <a href="{{ route('user.followers', $user->id) }}" class="btn btn-link"><strong>Followers: @{{ followersCount }}</strong></a>
                        </div>
                        <div class="pull-right">
                            @if (!$user->isMe())
                                <follow-button user-id="{{ $user->id }}" init-is-followed="{{ $user->isFollowed }}"  @followed="followingsCount++" @unfollowed="followingsCount--"></follow-button>
                            @endif
                        </div>
                    </div>
                </div>
              </follows>
            </div>
          </div>
            <div class="row">
            <div class="col-md-offset-2 col-md-8">
               <posts inline-template :link="'/api/id' + {{ $user->id }} + '/posts'" :init-posts-count="{{ $postCount }}">
                   <div class="panel panel-default">
                       <div class="panel-heading"><a href="" class="btn btn-link"><strong>Posts: <span v-text="postCounter"></span></strong></a></div>
                       <div class="panel-body">
                           @if($user->isMe())
                               <new-post @posted="add"></new-post>
                               <hr>
                           @endif
                           <ul class="media-list">
                               <div v-for="(post, index) in posts" :key="post.id">
                                  <post :item="post" :bus="bus"></post>
                                  <hr v-if="posts.length - 1 !== index">
                               </div>
                              <div v-if="loading" style="min-height: 150; padding-top: 75px;" class="text-center">
                                  <img src="{{ asset('img/ajax-loader.gif') }}" alt="">
                              </div>
                           </ul>
                       </div>
                       <edit-post :bus="bus"></edit-post>
                       <delete-post :bus="bus"></delete-post>
                   </div>
               </posts>
            </div>
        </div>
    </div>
@endsection
