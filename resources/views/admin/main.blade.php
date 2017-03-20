@extends('layouts.main')

@section('body')

@include('partials.nav')
@include('partials.title', ['subtitle' => 'Admin'])

<div class="tabs is-centered">
    <ul>
        <li><a href="{{ route('pages.index') }}">Pages</a></li>
        <li><a href="{{ route('events.index') }}">Events</a></li>
        <li><a>Users</a></li>
        <li><a>Correspondence</a></li>
    </ul>
</div>

@yield('admin.body')

@include('home.footer')

@endsection