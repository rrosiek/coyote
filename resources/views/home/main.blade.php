@extends('layouts.main')

@section('body')

    @include('home.hero')
    @include('home.aboutus')
    @include('home.brothers')
    @include('home.philanthropy')
    @include('home.pledging')
    @include('home.footer')

    <a class="to-top" v-scroll-to="{ id: 'home' }">
        <span class="icon is-medium">
            <i class="fa fa-angle-up"></i>
        </span>
    </a>
    
@endsection