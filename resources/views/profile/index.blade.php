@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Users</div>
                <div class="panel-body">
                    @foreach($users as $user)
                        <div class="col-md-4">
                            <div class="panel panel-primary">
                                <div class="card">
                                <div class="card-head">
                                    <img src="{{ asset('storage/background/275x/default.jpg') }}" width="275" alt="">
                                </div>
                                <div class="card-body">
                                    <div class="clearfix">
                                        <a href="{{ $user->path }}">
                                            <img src="{{ $user->getAvatarUrl() }}" width="80" class="avatar profile-avatar" alt="avatar">
                                        </a>
                                        @if(!$user->isMe())
                                        <div class="pull-right">
                                            <follow-button class="btn-follow" user-id="{{ $user->id }}" init-is-followed="{{ $user->isFollowed }}"></follow-button>
                                        </div>
                                        @endif
                                    </div>
                                    <a href="{{ $user->path }}">
                                        @if($fullname = $user->profile->getFullName())
                                            <h5 class="card-head">{{ $fullname }}</h5>
                                            <span class="card-span">{{ '@' . $user->username }}</span>
                                        @else
                                            <span class="card-head">{{ '@' . $user->username }}</span>
                                        @endif
                                    </a>
                                </div>
                            </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
