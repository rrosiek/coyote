@if (isset($required))
    <label class="label is-required">{{ $label }}</label>
@else
    <label class="label">{{ $label }}</label>
@endif

@if ($errors->has($name))
    <p class="control">
        <datepicker input-class="input is-danger" name="{{ $name }}" value="{{ old($name, $value) }}"></datepicker>
        <span class="help is-danger">{{ $errors->first($name) }}</span>
    </p>
@else
    <p class="control">
        <datepicker input-class="input" name="{{ $name }}" value="{{ old($name, $value) }}"></datepicker>
    </p>
@endif