@extends('layouts.main')

@section('body')

@include('partials.nav')
@include('partials.title')

<section class="section">
    <div class="container">
        <div class="columns">
            <payment></payment>
        </div>
    </div>
</section>

@endsection