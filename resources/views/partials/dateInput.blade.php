@if (isset($required))
    <label class="label required">{{ $label }}</label>
@else
    <label class="label">{{ $label }}</label>
@endif

@if ($errors->has($name))
    <p class="control has-icon has-icon-right">
    $date->setTimezone('America/New_York')->toDateString();
        <datepicker input-class="input is-danger" name="{{ $name }}" value="{{ old($name, $value->setTimezone('America/New_York')->toDateString()) }}"></datepicker>
        <span class="icon is-small">
            <i class="fa fa-warning"></i>
        </span>
        <span class="help is-danger">{{ $errors->first($name) }}</span>
    </p>
@else
    <p class="control">
        <datepicker input-class="input" name="{{ $name }}" value="{{ old($name, $value->setTimezone('America/New_York')->toDateString()) }}"></datepicker>
    </p>
@endif