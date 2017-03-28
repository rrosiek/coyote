<div class="field">
    @if (isset($required))
        <label class="label is-required">{{ $label }}</label>
    @else
        <label class="label">{{ $label }}</label>
    @endif

    @if ($errors->has($name))
        <p class="control has-icon has-icon-right">
            <textarea class="textarea is-danger" name="{{ $name }}">{!! old($name, $value) !!}</textarea>
            <span class="icon is-small">
                <i class="fa fa-warning"></i>
            </span>
            <span class="help is-danger">{{ $errors->first($name) }}</span>
        </p>
    @else
        <p class="control">
            <textarea class="textarea" name="{{ $name }}">{!! old($name, $value) !!}</textarea>
        </p>
    @endif
</div>