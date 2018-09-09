@extends('layouts.app')
@section('title', 'improv.ee')

@section('topright')
    @guest
        <a class="btn btn-sm btn-outline-secondary mr-3" href="{{ route('login') }}">{{ __('auth.login') }}</a>
        <a class="btn btn-sm btn-outline-secondary" href="{{ route('register') }}">{{ __('auth.register') }}</a>
    @else
        <a class="btn btn-sm btn-outline-secondary mr-3" href="{{ route('home') }}">{{ Auth::user()->name }}</a>
    @endguest
@endsection
@section('content')
            <div id="app"></div>
@endsection