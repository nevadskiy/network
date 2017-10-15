@extends('layouts.app')

@section('content')    
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <posts v-cloak inline-template :profile="1"  link="/api/feed" :init-posts-count="1">
                   <div class="panel panel-default">
                       <div class="panel-heading"><a href="" class="btn btn-link"><strong>Latest posts</strong></a></div>
                       <div class="panel-body">
                           <new-post @posted="add"></new-post>
                           <ul class="media-list">
                                <div v-if="isEmptyFeedback">
                                  <hr>
                                    <h4 class="text-center">Your feed is empty yet. <br> <a href="{{ route('users.index') }}">Start follow somebody</a></h4>
                                </div>
                               <div v-else v-for="post in posts" :key="post.id">
                                <hr>
                                <post :item="post" @deleted="remove"></post>
                            </div>
                           </ul>
                       </div>
                   </div>
               </posts>
            </div>
        </div>
    </div>
@endsection
