@extends('layouts.main')

@section('body')

@include('partials.nav')
@include('partials.title', ['title' => 'Reset Password'])

<section class="section">
    <div class="container">
        @if (session('status'))
            <div class="notification is-success">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('password.request') }}" method="post">
            {{ csrf_field() }}
            <input name="token" type="hidden" value="{{ $token }}">

            <div class="columns">
                <div class="column is-one-third is-offset-2">
                    @include('partials.textInput', ['name' => 'email', 'label' => 'E-Mail', 'value' => $email, 'required' => true])
                </div>
            </div>
            <div class="columns">
                <div class="column is-one-third is-offset-2">
                    @include('partials.passwdInput', ['name' => 'password', 'label' => 'Password', 'required' => true])
                </div>
                <div class="column is-one-third">
                    @include('partials.passwdInput', ['name' => 'password_confirmation', 'label' => 'Confirm Password', 'required' => true])
                </div>
            </div>
            <div class="columns">
                <div class="column is-offset-2">
                    <button class="button is-medium is-primary" type="submit" v-is-loading="">RESET PASSWORD</button>
                </div>
            </div>
        </form>
    </div>
</section>

@endsection