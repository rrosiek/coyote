@extends('layouts.main')

@section('body')

@include('partials.nav')
@include('partials.title')

<div class="tabs is-centered">
    <ul>
        <li><a href="{{ route('profiles.edit', Auth::user()) }}">Profile</a></li>
        <li><a href="{{ route('profiles.index') }}">Find Brothers</a></li>
    </ul>
</div>

@yield('members.body')

@include('partials.footer')

@endsection