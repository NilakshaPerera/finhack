@extends('layouts.app')
@section('content')

<div class="container">
    <div id="" name="" class="auth-box d-flex justify-content-center align-items-center">
        <div class="box">
            <h1 class="text-center h0 mb-4">{!! __(' Welcome to ACCA Finhack 2019') !!}</h1>
            <h2 class="text-center mb-4">{{ __('Please enter the login details.') }}</h2>
            <form method="POST" action="{{ route('login') }}" class="form-element">
                @csrf
                <div class="form-group text-center mb-4">
                    <input placeholder="Username" id="email" type="email" class=" form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                    @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group mb-4">
                    <input placeholder="Password" id="password" type="password" class=" form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                    @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-actions">
                    <div class="text-right">
                        <button type="submit" class="btn  acca-btn">
                           <span> {{ __('Login') }} </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
