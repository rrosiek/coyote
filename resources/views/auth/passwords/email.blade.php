@extends('layouts.main')

@section('body')

@include('partials.nav')
@include('partials.title', ['title' => 'Forgot Password'])

<section class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-half is-offset-3">
                @if (session('status'))
                    <div class="notification is-info">
                        {{ session('status') }}
                    </div>
                @endif
                @if (session('forceReset'))
                    <div class="notification is-info">
                        {{ session('forceReset') }}
                    </div>
                @endif
                @if ($errors->has('email'))
                    <div class="notification is-danger">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <form action="{{ route('password.email') }}" method="post">
                    {{ csrf_field() }}
                    <div class="field has-addons">
                        <p class="control is-expanded has-icon">
                            <input class="input is-large" name="email" type="email" placeholder="E-Mail" value="{{ old('email') }}">
                            <span class="icon">
                                <i class="fa fa-envelope"></i>
                            </span>
                        </p>
                        <p class="control">
                            <button class="button is-primary is-large" type="email">
                                Send Reset Link
                            </button>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection