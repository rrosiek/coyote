@extends('layouts.main')

@section('body')

@include('partials.nav')
@include('partials.title')

<section class="section">
    <div class="container is-fluid">
        <form action="{{ route('events.store') }}" method="post">
            {{ csrf_field() }}

            @include('members.events.form')
            <button type="submit">Submit</button>
        </form>
    </div>

</section>

@endsection