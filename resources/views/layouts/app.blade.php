<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>window.laravel = {csrfToken: '{{ csrf_token() }}'}</script>
        <script> var base = '{{url(' / ') . ' / '}}';</script>
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="shortcut icon" type="image/png" href="{{ url('/') . '/images/favicon.ico' }}"/>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/vuejs-dialog.min.css') }}" rel="stylesheet">
        <script>
            var flag = '{{ (Auth::user())? true : false }}';
            var base = '{{url('/') . '/'}}';
        </script>
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="default d-flex align-items-center justify-content-center" style="min-height:100vh">
    <div>
        <nav id="" name="" class="navbar navbar-expand-lg navbar-light header-nav">
            <div class="container">
                <span id="clock-el"></span>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul id="main-menu" name="main-menu" class="navbar-nav mr-auto center-div">
                    </ul>
                    <span class="navbar-text">
                        <ul id="control-menu" name="control-menu" class="navbar-nav ml-auto">                                            
                            @guest
                            <li class="nav-item">
                                <!--<a class="nav-link" href="{ route('login') }}">{ __('Login') }}</a>-->
                            </li>
                            @if (Route::has('register'))
                            <!--<li class="nav-item">
                                <a class="nav-link" href="{ route('register') }}">{{ __('Register') }}</a>
                            </li>-->
                            @endif
                            @else
                            <li class="nav-item dropdown">
                             <a class="nav-link" href="" onclick="">
                                    <!--   { __('Logout') }} -->
                                  <!-- <img style="height: 20px" src="{{ url('/') . '/images/logout.png' }}" title="Logout"> -->
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                            @endguest
                        </ul>
                    </span>
                </div>
                
            </div>
        </nav>
       
            <main class="p-4">
            <div class="container ">
                <div class="row">
                <div class="col logo p-0">
                    <img src="{{url('images/logo.png')}}" alt="" class="">
                </div>
                </div>
                
                @yield('content')

                <div class="bottom-btn w-100 text-center">
                <img src="{{url('images/bot-btn.png')}}" alt="" class="">
                </div>
                <div class="row">
                <div class="col foot-logo p-0">
                    <img src="{{url('images/think-ahead.png')}}" alt="" class="">
                </div>

                </div>
                </div>
            </main>
</div>
        <footer id="site-footer" name="site-footer">
            <div class="container text-center">
            </div>
        </footer>
        <div class="modal fade custom-modal" id="modalTimeOut" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <h4>Your time for this round is up. Please click continue to end the current round.</h4>
                    </div>
                    <div class="modal-footer">
                        <a id="modalTimeoutRedirect"  onclick="$('#modalTimeOut').modal('hide');" href="" class="btn btn-primary acca-btn ">Continue</a>
                    </div>
                </div>
            </div>
        </div>
    </body>

