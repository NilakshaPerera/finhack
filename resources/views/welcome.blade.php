@extends('layouts.app')
@section('content')

<div id="app" class="container">
    <transition name="fade">
        <router-view></router-view>
    </transition>
    
</div>

@endsection
