@extends('members.main')

@section('members.body')

    <div class="container">
        @foreach ($lifetime as $member)
            @if ($loop->index % 3 === 0)
                <div class="columns">
            @endif
                <div class="column has-text-centered">
                    <h4 class="title is-4">
                        {{ $member->first_name }} {{ $member->last_name }}
                    </h4>
                </div>
            @if ($loop->iteration % 3 === 0 or $loop->last)
                </div>
            @endif
        @endforeach
    </div>

@endsection