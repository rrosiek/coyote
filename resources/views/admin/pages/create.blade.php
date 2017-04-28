@extends('admin.main')

@section('admin.body')

<div class="container is-fluid">
    @include('partials.notify')
    <form action="{{ route('pages.store') }}" method="post">
        {{ csrf_field() }}
        @include('admin.pages.form')
    </form>
</div>

@endsection

@section('scripts')
    @include('partials.tinymce')
@endsection
