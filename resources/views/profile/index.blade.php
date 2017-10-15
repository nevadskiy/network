@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><button class="btn btn-link"><strong>{{ $page }}</strong></button></div>
                <div class="panel-body">
                    @foreach($users as $user)
                       @include('profile._card')
                    @endforeach
                </div>
            </div>
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
