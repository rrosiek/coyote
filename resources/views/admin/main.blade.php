@extends('layouts.main')

@section('body')

@include('partials.nav')
@include('partials.title', ['subtitle' => 'Admin'])

<div class="tabs is-centered">
    <ul>
        <li class="{{ starts_with(Route::currentRouteName(), 'pages') ? 'is-active' : '' }}">
            <a href="{{ route('pages.index') }}">Pages</a>
        </li>
        <li class="{{ starts_with(Route::currentRouteName(), 'events') ? 'is-active' : '' }}">
            <a href="{{ route('events.index') }}">Events</a>
        </li>
        <li class="{{ starts_with(Route::currentRouteName(), 'users') ? 'is-active' : '' }}">
            <a href="{{ route('users.index') }}">Users</a>
        </li>
        <li class="{{ starts_with(Route::currentRouteName(), 'correspondence') ? 'is-active' : '' }}">
            <a href="{{ route('correspondence.index') }}">Correspondence</a>
        </li>
        <li class="{{ starts_with(Route::currentRouteName(), 'maillists') ? 'is-active' : '' }}">
            <a href="{{ route('maillists.index') }}">Mailing Lists</a>
        </li>
        <li class="{{ starts_with(Route::currentRouteName(), 'minutes') ? 'is-active' : '' }}">
            <a href="{{ route('minutes.admin') }}">Minutes</a>
        </li>
        <li class="{{ starts_with(Route::currentRouteName(), 'newsletters') ? 'is-active' : '' }}">
            <a href="{{ route('newsletters.admin') }}">Newsletters</a>
        </li>
        <li class="{{ starts_with(Route::currentRouteName(), 'files') ? 'is-active' : '' }}">
            <a href="{{ route('files.index') }}">Files</a>
        </li>
        <li>
            <a href="{{ route('logout') }}">Logout</a>
        </li>
    </ul>
</div>

@yield('admin.body')

@include('partials.footer')

@endsection