@extends('layouts.main')

@section('body')

@include('partials.nav')
@include('partials.title')

<div class="tabs is-centered">
    <ul>
        <li class="{{ starts_with(Route::currentRouteName(), 'profiles.edit') ? 'is-active' : '' }}">
            <a href="{{ route('profiles.edit', Auth::user()) }}">Profile</a>
        </li>
        <li class="{{ starts_with(Route::currentRouteName(), 'profiles.index') ? 'is-active' : '' }}">
            <a href="{{ route('profiles.index') }}">Find Brothers</a>
        </li>
        <li>
            <a href="{{ route('logout') }}">Logout</a>
        </li>
    </ul>
</div>

@yield('members.body')

@include('partials.footer')

@endsection