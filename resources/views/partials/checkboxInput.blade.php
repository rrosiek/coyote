<div class="field">
    <p class="control">
        <input id="{{ $name }}" name="{{ $name }}" type="checkbox" {{ old($name, $value) ? 'checked' : '' }}>
        <label class="checkbox {{ isset($required) ? 'is-required' : '' }}" for="{{ $name }}">{{ $label }}</label>
        @if ($errors->has($name))
            <span class="help is-danger">{{ $errors->first($name) }}</span>
        @endif
    </p>
</div>
