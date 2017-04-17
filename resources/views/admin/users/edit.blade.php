@extends('admin.main')

@section('admin.body')

<section>
    <div class="container">
        <form action="{{ route('users.update', [$user]) }}" method="post">
            {{ method_field('PUT') }}
            {{ csrf_field() }}

            @include('members.profiles.form')

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
