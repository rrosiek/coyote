@extends('admin.main')

@section('admin.body')

<div class="container is-fluid">
    <form action="{{ route('newsletters.store') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="columns">
            <div class="column is-half">
                @include('partials.textInput', ['name' => 'name', 'label' => 'Name / Label', 'value' => $newsletter->name, 'required' => true])
            </div>
        </div>
        <div class="columns">
            <div class="column is-half">
                @include('partials.fileInput', ['name' => 'document', 'label' => 'Document', 'value' => $newsletter->document, 'required' => true])
            </div>
        </div>
        <button class="button is-medium is-primary" type="submit" v-is-loading="">SAVE</button>
    </form>
</div>

@endsection