@extends('admin.main')

@section('admin.body')

<section>
    <div class="container is-fluid">
        <h5 class="title is-5">Primary Image</h5>
        <form action="{{ route('home-pages.update',  ['homePage' => $homePage->id]) }}" method="post">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            <div class="columns">
                <div class="column is-4">
                    <p class="image is-4x3">
                        <img src="{{ $homePage->image_public_path }}">
                    </p>
                </div>
                <div class="column is-6">
                    <div class="field">
                        <p class="control">
                            <input name="image" type="file">
                            <span class="help">For the best format and resolution, the picture uploaded should be 800x600 or at least a 4x3 ratio.</span>
                        </p>
                    </div>
                    <p class="content">
                        <a class="button is-primary" v-is-loading="">Upload</a>
                    </p>
                </div>
            </div>
        </form>
        <h5 class="title is-5">Content</h5>
        <p class="content">The snippet content is the message on the home page and the details content is what will appear on the actual page when <em>Read More</em> is clicked.</p>
        <form action="{{ route('home-pages.update',  ['homePage' => $homePage->id]) }}" method="post">
            {{ method_field('PUT') }}
            {{ csrf_field() }}

            @include('partials.textareaInput', ['name' => 'snippet', 'label' => 'Snippet', 'value' => $homePage->snippet, 'required' => true])
            @include('partials.textareaInput', ['name' => 'detail', 'label' => 'Details', 'value' => $homePage->detail, 'required' => true])

            <button class="button is-medium is-primary" type="submit" v-is-loading="">SAVE</button>
        </form>
    </div>
</section>

@endsection

@include('partials.tinymce')