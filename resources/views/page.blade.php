@extends('layouts.main')

@section('body')

@include('partials.nav')
@include('partials.title')

<section class="section">
    <div class="container">
        {!! $page->detail !!}
    </div>
</section>

@include('home.footer')

@endsection