<div class="columns">
    <div class="column is-5">
        <label class="label is-required">Title</label>
        <p class="control {{ $errors->has('title') ? 'has-icon has-icon-right' : '' }}">
            <input
                @blur="titleToSlug($event, 'slug')"
                class="input {{ $errors->has('title') ? 'is-danger' : '' }}"
                name="title"
                type="text"
                value="{{ old('title', $page->title) }}"
            >
            @if ($errors->has('title'))
                <span class="icon is-small">
                    <i class="fa fa-warning"></i>
                </span>
                <span class="help is-danger">{{ $errors->first('title') }}</span>
            @endif
        </p>
    </div>
    <div class="column is-5">
        <label class="label is-required">URL Slug</label>
        <p class="control {{ $errors->has('slug') ? 'has-icon has-icon-right' : '' }}">
            <input
                class="input {{ $errors->has('slug') ? 'is-danger' : '' }}"
                id="slug"
                name="slug"
                type="text"
                value="{{ old('slug', $page->slug) }}"
            >
            @if ($errors->has('slug'))
                <span class="icon is-small">
                    <i class="fa fa-warning"></i>
                </span>
                <span class="help is-danger">{{ $errors->first('slug') }}</span>
            @endif
        </p>
    </div>
</div>
<div class="columns">
    <div class="column is-10">
        @include('partials.textareaInput', ['name' => 'detail', 'label' => 'Details', 'value' => $page->detail, 'required' => true])
        <button class="button is-medium is-primary" type="submit" v-is-loading="">SAVE</button>
    </div>
</div>
