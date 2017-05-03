@extends('admin.main')

@section('admin.body')

<div class="container is-fluid">
    <div class="notification is-info">
        If uploading <a href="{{ route('minutes.create') }}">meeting minutes</a> or <a href="{{ route('newsletters.create') }}">newsletters</a>, please use those locations.
    </div>
    <form action="{{ route('files.store') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="columns">
            <div class="column is-half">
                @include('partials.textInput', ['name' => 'description', 'label' => 'Description / Label', 'value' => $file->description, 'required' => true])
            </div>
        </div>
        <div class="columns">
            <div class="column is-half">
                @include('partials.fileInput', ['name' => 'file', 'label' => 'File', 'value' => $file->file, 'required' => true])
            </div>
        </div>
        <button class="button is-medium is-primary" type="submit" v-is-loading="">SAVE</button>
    </form>
</div>

@endsection