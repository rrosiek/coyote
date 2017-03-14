@extends('layouts.main')

@section('body')

@include('partials.nav')
@include('partials.title')

<section class="section">
    <div class="container is-fluid">
        <form action="{{ route('events.update',  ['events' => $event->id]) }}" method="post">
            {{ method_field('PUT') }}
            {{ csrf_field() }}

            @include('members.events.form')
            <button class="button is-medium is-primary" type="submit" v-is-loading="">SAVE</button>
        </form>
    </div>
</section>

@endsection