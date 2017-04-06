@extends('layouts.main')

@section('body')

@include('partials.nav')
@include('partials.title')

<section class="section">
    <div class="container">
        @include('partials.notify')
        <div class="columns">
            <div class="column is-3 is-offset-3">
                <a class="button is-medium is-fullwidth is-facebook">
                    <span class="icon">
                        <i class="fa fa-facebook"></i>
                    </span>
                    <span>Login with Facebook</span>
                </a>
            </div>
            <div class="column is-3">
                <a class="button is-medium is-fullwidth is-google">
                    <span class="icon">
                        <i class="fa fa-google"></i>
                    </span>
                    <span>Login with Google</span>
                </a>
            </div>
        </div>
        <div class="columns">
            <div class="column has-text-centered">
                <h5 class="title is-5">OR, SIGN IN</h5>
            </div>
        </div>
        <div class="columns">
            <div class="column is-6 is-offset-3">
                <form action="{{ route('login') }}" method="post">
                    {{ csrf_field() }}

                    @if ($errors->has('email') or $errors->has('password'))
                        <div class="notification is-danger">E-mail or password incorrect</div>
                    @endif
                    
                    <div class="field">
                        <p class="control has-icon">
                            <input class="input is-large" name="email" type="email" placeholder="Email" value="{{ old('email') }}" autofocus>
                            <span class="icon">
                                <i class="fa fa-envelope"></i>
                            </span>
                        </p>
                    </div>
                    <div class="field">
                        <p class="control has-icon">
                            <input class="input is-large" name="password" type="password" placeholder="Password">
                            <span class="icon">
                                <i class="fa fa-key"></i>
                            </span>
                        </p>
                    </div>
                    <div class="field">
                        <p class="control">
                            <input id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="checkbox" for="remember">Remember Me</label>
                        </p>
                    </div>
                    <div class="field">
                        <button class="button is-medium is-primary is-fullwidth" type="submit">Login</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="columns">
            <div class="column is-3 is-offset-3">
                <a href="{{ route('password.request') }}">Forgot Your Password?</a>
            </div>
            <div class="column is-3 has-text-right">
                <a href="{{ route('register') }}">Register Here</a>
            </div>
        </div>
    </div>
</section>

@endsection