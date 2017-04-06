<div class="field">
    <label class="label {{ isset($required) ? 'is-required' : '' }}">{{ $label }}</label>

    @if ($errors->has($name))
        <p class="control has-icon has-icon-right">
            <span class="select is-danger">
                <select name="{{ $name }}">
                    @foreach ($values as $opt => $text)
                        <option value="{{ $opt }}" {{ $opt == old($name, $value) ? 'selected' : '' }}>{{ $text }}</option>
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
                        <option value="{{ $opt }}" {{ $opt == old($name, $value) ? 'selected' : '' }}>{{ $text }}</option>
                    @endforeach
                </select>
            </span>
        </p>
    @endif
</div>