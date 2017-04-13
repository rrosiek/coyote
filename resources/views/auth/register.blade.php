@extends('layouts.main')

@section('body')

@include('partials.nav')
@include('partials.title')

<section class="section">
    <div class="container">
        @include('partials.notify')

        @if (session()->has('oauthSuccess'))
            <div class="notification is-info">
                You have successfully logged in with a social account, but you still need to register and verify your membership with the site using the same email registered with the social provider.  If you are already registered and need to update your email address, please contact {{ env('MAIL_WEBADMIN')}}.
            </div>
        @endif
        <form action="{{ route('register') }}" method="post">
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