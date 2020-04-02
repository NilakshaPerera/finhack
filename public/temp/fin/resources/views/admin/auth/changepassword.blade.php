@extends('layouts.app')
@section('content')

<div class=" h-spacer"></div>
<div class="container">
    <div class="row  auth-box d-flex justify-content-center align-items-center">
        <div class="col-md-8">
            <div class="">
                <h2 class="text-center">{{ __('Change password') }}</h2>
                <div class="card-body">
                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <form class="form-horizontal" method="POST" action="{{ route('admin.changePassword') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                            <input id="current-password" type="password" class="form-control" name="current-password" required placeholder="Current Password">
                            @if ($errors->has('current-password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('current-password') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                            <input id="new-password" type="password" class="form-control" name="new-password" required placeholder="New Password">
                            @if ($errors->has('new-password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('new-password') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required placeholder="Confirm New Password">
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary red-button round-button">
                                Change Password
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<div class=" h-spacer"></div>

@endsection

