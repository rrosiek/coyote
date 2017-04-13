@extends('layouts.main')

@section('body')

@include('partials.nav')
@include('partials.title')

<div class="tabs is-centered">
    <ul>
        <li><a>Profile</a></li>
        <li><a>Find Brothers</a></li>
    </ul>
</div>

@yield('members.body')

@include('partials.footer')

@endsection