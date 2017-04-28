@extends('members.main')

@section('members.body')

@if (request('filter'))
    @include('members.profiles.search')
@else
    <div class="container">
        <div class="column is-half is-offset-3">
            <form class="field has-addons" method="get">
                <p class="control is-expanded">
                    <input class="input is-large" name="filter" placeholder="By Name or E-Mail" type="text">
                </p>
                <p class="control">
                    <button class="button is-primary is-large" type="submit">
                        Search
                    </button>
                </p>
            </form>
        </div>
        <div class="columns">
            <div class="column has-text-centered">
                <h5 class="title is-5">OR BY MAP</h5>
            </div>
        </div>
        <div class="columns">
            <div class="column is-10 is-offset-1">
                <member-map></member-map>
            </div>
        </div>
    </div>
@endif

@endsection

@section('scripts')
    @include('partials.googlemaps')
@endsection
