@extends('layouts.app')

@section('content')    
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
              <posts inline-template link="/api/feed">
                   <div class="panel panel-default">
                       <div class="panel-heading"><a href="" class="btn btn-link"><strong>Latest posts</strong></a></div>
                       <div class="panel-body">
                           <new-post @posted="add"></new-post>
                           <hr>
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
