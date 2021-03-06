@extends('admin.main')

@section('admin.body')

<div class="container is-fluid">
    @include('partials.notify')

    @if ($page->home_page)
        <h4 class="title is-4">Primary Image</h4>
        <form action="{{ route('pages.update', $page) }}" method="post" enctype="multipart/form-data">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            <div class="columns">
                <div class="column is-4">
                    <p class="image is-4x3">
                        <img src="{{ $page->image_public_path }}">
                    </p>
                </div>
                <div class="column is-6">
                    <div class="field">
                        <p class="control">
                            <input class="input" name="image" type="file">
                            <span class="help">For the best format and resolution, the picture uploaded should be 800x600 or at least a 4x3 ratio.</span>
                        </p>
                    </div>
                    <p class="content">
                        <button class="button is-primary" type="submit" v-is-loading="">Upload</button>
                    </p>
                </div>
            </div>
        </form>

        <br>

        <div class="columns">
            <div class="column is-10">
                <h4 class="title is-4">Content</h4>
                <p class="content">The snippet content is the message on the home page and the details content is what will appear on the actual page when <em>Read More</em> is clicked.</p>
                <form action="{{ route('pages.update', $page) }}" method="post">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}

                    @include('partials.textareaInput', ['name' => 'snippet', 'label' => 'Snippet', 'value' => $page->snippet, 'required' => true])
                    @include('partials.textareaInput', ['name' => 'detail', 'label' => 'Details', 'value' => $page->detail, 'required' => true])

                    <button class="button is-medium is-primary" type="submit" v-is-loading="">SAVE</button>
                </form>
            </div>
        </div>
    @else
        <form action="{{ route('pages.update', $page) }}" method="post">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            @include('admin.pages.form')
        </form>
    @endif
</div>

@endsection

@section('scripts')
    @include('partials.tinymce')
@endsection
