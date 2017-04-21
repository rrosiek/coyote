@extends('layouts.main')

@section('body')

@include('partials.nav')
@include('partials.title')

<section class="section">
    <div class="container">
        <div class="content">
            {!! $page->detail !!}
        </div>
    </div>
</section>

@include('home.footer')

@endsection