@extends('layouts.main')

@section('body')

@include('partials.nav')
@include('partials.title', ['subtitle' => 'Admin'])

<div class="tabs is-centered">
    <ul>
        <li><a href="{{ route('home-pages.index') }}">Home Pages</a></li>
        <li><a href="{{ route('events.index') }}">Events</a></li>
        <li><a href="{{ route('users.index') }}">Users</a></li>
        <li><a>Correspondence</a></li>
    </ul>
</div>

@yield('admin.body')

@include('partials.footer')

@endsection