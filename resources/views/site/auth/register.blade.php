@extends('layouts.app')
@section('content')
<div id="carousal-section" name="carousal-section">
    <div class="container">
        <div id="carouselContent" class="carousel slide col-md-12 p-4 center-div" data-ride="carousel">
            <h2 class="text-center mb-3 orange-text">Did you know you have the right to ask questions? </h2>
            <div class="carousel-inner text-center" role="listbox">
                <div class="carousel-item active text-center">
                    <h4><b>{{ __('I : Access to information') }} </b></h4>
                    <p>{{ __('Access to information denotes that the ability of people to receive information with no hindrance. It means the free availability of information and also diverse range of means of receiving information are operated within the society. Particularly, what is most significant is that the ensuring a state of affairs that enshrines no censorship or restriction on media and having freedom of access to information without any undue influence.') }} </p>
                </div>
                <div class="carousel-item text-center ">  
                    <h4><b>{{ __('II : Responsibility of state institutions to publish information') }} </b></h4>
                    <p> {{ __('State institutions should be embedded with a responsibility to establish an enabling ambiance for people to have access to information which are significant for them. Further, it will also be the obligation of the state to guarantee that the information are available for people in a simple and an understandable manner.') }} </p>
                </div>
                <div class="carousel-item text-center ">
                       <h4><b>{{ __('III : Responsibility to release information') }} </b></h4>
                    <p> {{ __('Responsibility to release information signifies the obligation of releasing information affiliated to different personnel upon a due request. Subject to exceptions such as state secrets, people should have the right to demand information from state institutions. Releasing private information and information related to accomplishments being done using the public tax funds is a responsibility of public officials. It is a right of the people to receive such information without any delay and with complete accuracy.') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class=" h-spacer"></div>
<div class="container">
    <div id="auth-form" name="auth-form" class="row justify-content-center">

        <div class="col-md-5 gray-back">
            
            <div class="">
                <div class="card-body">
                    <h3 class="text-center orange-text">{{ __('Register Now') }}</h3>
                    <h5 class="text-center ">{{ __('Have you used your right to information?') }}</h5>
                    <h5 class="text-center  mb-4">{{ __('We would like to hear your story.') }}</h5>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right orange-text">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right orange-text">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right orange-text">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right orange-text">{{ __('Re-Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <input id="refid" type="hidden" name="refid" value="{{ isset($_GET['ref']) ? $_GET['ref'] : 0 }}">

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4 btn-holder">
                                <button type="submit" class="btn btn-primary orange-button">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3 gray-back map-container">
              <div class="card-body">
            <img src="{{ url('/') . '/images/home/map.png' }}">
              </div>
        </div>

    </div>
</div>
<div class=" h-spacer"></div>
@endsection
