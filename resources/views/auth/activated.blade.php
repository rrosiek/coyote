@extends('layouts.main')

@section('body')

@include('partials.nav')
@include('partials.title')

<section class="section">
    <div class="container">
        <div class="notification is-success">
            User {{ $user->name }} has been activated and notified.
        </div>
    </div>
</section>

@endsection