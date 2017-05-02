@extends('admin.main')

@section('admin.body')

<div class="container is-fluid">
    <form action="{{ route('events.store') }}" method="post">
        {{ csrf_field() }}

        @include('admin.events.form')

        <button class="button is-medium is-primary" type="submit" v-is-loading="">SAVE</button>
    </form>
</div>

@endsection