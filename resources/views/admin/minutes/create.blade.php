@extends('admin.main')

@section('admin.body')

<div class="container is-fluid">
    <form action="{{ route('minutes.store') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="columns">
            <div class="column is-half">
                @include('partials.dateInput', ['name' => 'meeting_date', 'label' => 'Meeting Date', 'value' => $minutes->meeting_date, 'required' => true])
            </div>
        </div>
        <div class="columns">
            <div class="column is-half">
                @include('partials.fileInput', ['name' => 'document', 'label' => 'Document', 'value' => $minutes->document, 'required' => true])
            </div>
        </div>
        <button class="button is-medium is-primary" type="submit" v-is-loading="">SAVE</button>
    </form>
</div>

@endsection