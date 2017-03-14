@if (isset($required))
    <label class="label is-required">{{ $label }}</label>
@else
    <label class="label">{{ $label }}</label>
@endif

@if ($errors->has($name))
    <p class="control has-icon has-icon-right">
        <span class="select is-danger">
            <select name="{{ $name }}">
                @foreach ($values as $opt => $text)
                    @if ($opt == old($name, $value))
                        <option value="{{ $opt }}" selected>{{ $text }}</option>
                    @else
                        <option value="{{ $opt }}">{{ $text }}</option>
                    @endif
                @endforeach
            </select>
        </span>
        <span class="help is-danger">{{ $errors->first($name) }}</span>
    </p>
@else
    <p class="control">
        <span class="select">
            <select name="{{ $name }}">
                @foreach ($values as $opt => $text)
                    @if ($opt == old($name, $value))
                        <option value="{{ $opt }}" selected>{{ $text }}</option>
                    @else
                        <option value="{{ $opt }}">{{ $text }}</option>
                    @endif
                @endforeach
            </select>
        </span>
    </p>
@endif