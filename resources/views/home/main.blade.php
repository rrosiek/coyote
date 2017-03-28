@extends('layouts.main')

@section('body')

    @include('home.hero')
    @include('home.aboutus', ['data' => $sections['about-us']])
    @include('home.brothers', ['data' => $sections['brothers']])
    @include('home.philanthropy', ['data' => $sections['philanthropy']])
    @include('home.pledging', ['data' => $sections['pledging']])
    @include('home.footer')

    <a class="to-top" v-scroll-to="{ id: 'home' }">
        <span class="icon is-medium">
            <i class="fa fa-angle-up"></i>
        </span>
    </a>
    
@endsection