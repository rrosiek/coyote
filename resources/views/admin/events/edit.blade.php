@extends('admin.main')

@section('admin.body')

<section>
    <div class="container is-fluid">
        <form action="{{ route('events.update', [$event]) }}" method="post">
            {{ method_field('PUT') }}
            {{ csrf_field() }}

            @include('admin.events.form')

            <button class="button is-medium is-primary" type="submit" v-is-loading="">SAVE</button>
        </form>
    </div>
</section>

@endsection