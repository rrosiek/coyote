@extends('members.main')

@section('members.body')

<section>
    <div class="container">
        @include('partials.notify')

        <form action="{{ route('users.update', [$user]) }}" method="post">
            {{ method_field('PUT') }}
            {{ csrf_field() }}

            @include('members.users.form')

            <br>

            <div class="columns">
                <div class="column">
                    <button class="button is-medium is-primary" type="submit" v-is-loading="">SAVE</button>
                </div>
            </div>
        </form>
    </div>
</section>

@endsection
