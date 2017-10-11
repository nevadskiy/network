@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @forelse($posts as $post)
                    <hr>
                    @include('posts._post')
                @empty
                    <p>There are no posts by this user.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
