@extends('layouts.main')

@section('body')

@include('partials.nav')
@include('partials.title')

<section class="section">
    <div class="container">
        @foreach ($events as $e)
            <div class="tile is-ancestor">
                <div class="tile is-parent is-3">
                    @if ($loop->iteration % 2 === 0)
                        <div class="tile is-child notification is-primary has-text-centered">
                    @else
                        <div class="tile is-child notification is-warning has-text-centered">
                    @endif
                            <p class="title">{{ $e['start']->format('M') }} {{ $e['start']->format('j') }}</p>
                            @if (!$e['allDay'])
                                <p class="subtitle">{{ $e['start']->format('g:ia') }}</p>
                            @else
                                <p class="subtitle">All Day</p>
                            @endif
                            @if ($e['end'])
                                <p class="subtitle">for {{ $e['end'] }}</p>
                            @endif
                        </div>
                </div>
                <div class="tile is-parent">
                    <div class="tile is-child notification">
                        <p class="title">{{ $e['title'] }}</p>
                        <p class="subtitle">{{ $e['detail'] }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

@include('home.footer')

@endsection