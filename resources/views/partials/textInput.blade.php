@if (isset($required))
    <label class="label required">{{ $label }}</label>
@else
    <label class="label">{{ $label }}</label>
@endif

@if ($errors->has($name))
    <p class="control has-icon has-icon-right">
        <input class="input is-danger" name="{{ $name }}" type="text" value="{{ old($name, $value) }}">
        <span class="icon is-small">
            <i class="fa fa-warning"></i>
        </span>
        <span class="help is-danger">{{ $errors->first($name) }}</span>
    </p>
@else
    <p class="control">
        <input class="input" name="{{ $name }}" type="text" value="{{ old($name, $value) }}">
    </p>
@endif