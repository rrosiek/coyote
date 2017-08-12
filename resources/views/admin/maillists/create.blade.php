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
                @include('partials.textInput', ['name' => 'description', 'label' => 'Description', 'value' => '', 'required' => true])
            </div>
        </div>
        <div class="columns">
            <div class="column is-half">
                <label class="label is-required">List Address</label>
                <div class="field has-addons">
                    <p class="control">
                        <input class="input" name="list_address" type="text">
                    </p>
                    <p class="control">
                        <a class="button is-static">
                            {{ '@' . env('MAILGUN_INBOUND_DOMAIN') }}
                        </a>
                    </p>
                </div>
            </div>
        </div>
        <div class="columns">
            <div class="column is-half">
                <div class="field">
                    <div class="control">
                        <label class="label is-required">List Access</label>
                        <label class="radio">
                            <input type="radio" name="access_level" value="everyone" checked> Anyone
                        </label>
                        <label class="radio">
                            <input type="radio" name="access_level" value="members"> List members only
                        </label>
                    </div>
                    <p class="help">By default, <em>anyone</em> can email the group.  To only accept messages from list members, select <em>List members only</em>.</p>
                </div>
            </div>
        </div>
        <button class="button is-medium is-primary" type="submit" v-is-loading="">SAVE</button>
    </form>
</div>

@endsection