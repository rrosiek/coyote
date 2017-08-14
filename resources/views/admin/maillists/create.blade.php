@extends('admin.main')

@section('admin.body')

<div class="container is-fluid">
    <form action="{{ route('maillists.store') }}" method="post">
        {{ csrf_field() }}

        <div class="columns">
            <div class="column is-half">
                @include('partials.textInput', ['name' => 'name', 'label' => 'Name', 'value' => '', 'required' => true])
            </div>
        </div>
        <div class="columns">
            <div class="column is-half">
                <label class="label is-required">List Address</label>
                <div class="field has-addons">
                    <p class="control">
                        <input class="input" name="address" type="text" value="{{ old('address') }}">
                    </p>
                    <p class="control">
                        <a class="button is-static">
                            {{ '@' . env('MAILGUN_INBOUND_DOMAIN') }}
                        </a>
                    </p>
                </div>
                @if ($errors->has('address'))
                    <span class="help is-danger">{{ $errors->first('address') }}</span>
                @endif
            </div>
        </div>
        <div class="columns">
            <div class="column is-half">
                <div class="field">
                    <p class="control">
                        <label class="label is-required">Access</label>
                        <label class="radio">
                            <input type="radio" name="access_level" value="everyone" {{ old('access_level') === 'everyone' ? 'checked' : '' }}> Anyone
                        </label>
                        <label class="radio">
                            <input type="radio" name="access_level" value="members" {{ old('access_level') === 'members' ? 'checked' : '' }}> List members only
                        </label>
                        @if ($errors->has('access_level'))
                            <span class="help is-danger">{{ $errors->first('access_level') }}</span>
                        @endif
                    </p>
                    <p class="help">By default, <em>anyone</em> can email the group.  To only accept messages from list members, select <em>List members only</em>.</p>
                </div>
            </div>
        </div>
        <div class="columns">
            <div class="column is-half">
                @include('partials.textareaInput', ['name' => 'members', 'label' => 'Members', 'value' => '', 'required' => true])
                <p class="help">Enter one email address per line.</p>
            </div>
        </div>
        <button class="button is-medium is-primary" type="submit" v-is-loading="">SAVE</button>
    </form>
</div>

@endsection