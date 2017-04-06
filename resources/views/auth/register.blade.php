@extends('layouts.main')

@section('body')

@include('partials.nav')
@include('partials.title')

<section class="section">
    <div class="container">
        @include('partials.notify')

        @if (isset($oauthSuccess))
            <div class="notification is-info">
                You have successfully logged in with a social provider, but you still need to register and verify your membership with the site.
            </div>
        @endif
        <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            @include('auth.registerForm')

            <br>

            <div class="columns">
                <div class="column">
                    <button class="button is-medium is-primary" type="submit" v-is-loading="">REGISTER</button>
                </div>
            </div>
        </form>
    </div>
</section>

@include('home.footer')

@endsection