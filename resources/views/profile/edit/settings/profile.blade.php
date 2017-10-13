<div class="panel panel-default">
    <div class="panel-heading" class="text-center"><strong>Profile Editing</strong></div>

    <div class="panel-body">
        <form class="form-horizontal" method="POST" action="{{ route('settings.profile') }}" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                <label for="first_name" class="col-md-4 control-label">First name</label>

                <div class="col-md-6">
                    <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') ?: $user->profile->first_name }}" required autofocus>

                    @if ($errors->has('first_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                <label for="last_name" class="col-md-4 control-label">Last name</label>

                <div class="col-md-6">
                    <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') ?: $user->profile->last_name }}" required autofocus>

                    @if ($errors->has('last_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>


            <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label" for="input-field">Avatar</label>
                <div class="col-md-6">
                    <label for="input-field">
                        <img src="{{ $user->getAvatarUrl() }}" width="125px" class="avatar profile-avatar" alt="">
                        <input name="avatar" type="file" id="input-field">
                        <p class="help-block">Max size: 1mb</p>
                    </label>
                </div>
            </div>

            {{--<div class="form-group">--}}
                {{--<label class="col-md-4 control-label" for="input-field">Backgroung</label>--}}
                {{--<div class="col-md-6">--}}
                    {{--<label for="input-field">--}}
                        {{--<img src="{{ asset('storage/avatars/default/boy.png') }}" width="125px" class="avatar profile-avatar" alt="">--}}
                    {{--</label>--}}
                    {{--<input name="avatar" type="file" id="input-field">--}}
                    {{--<p class="help-block">Max size: 4mb</p>--}}
                {{--</div>--}}
            {{--</div>--}}

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>