@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-md-offset-1">
                <ul class="nav nav-pills nav-stacked">
                    <li{{ isRouteActive('settings.account') }}><a href="{{ route('settings.account') }}">Account</a></li>
                    <li{{ isRouteActive('settings.profile') }}><a href="{{ route('settings.profile') }}">Profile</a></li>
                </ul>
            </div>
            <div class="col-md-7">
                @if(view()->exists('profile.edit.' . Route::currentRouteName()))
                    @include('profile.edit.' . Route::currentRouteName())
                @endif
            </div>
        </div>
    </div>
@endsection
