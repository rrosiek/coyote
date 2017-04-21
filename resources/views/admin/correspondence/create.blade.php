@extends('admin.main')

@section('admin.body')

<section>
    <div class="container is-fluid">
        @include('partials.notify')
        <p class="content">
            Please be aware that this page will send out an e-mail to the entire alumni base, use with care.
        </p>
        <form action="{{ route('correspondence.store') }}" method="post">
            {{ csrf_field() }}

            <div class="columns">
                <div class="column is-half">
                    @include('partials.textInput', ['name' => 'subject', 'label' => 'Subject', 'value' => $msg->subject, 'required' => true])
                </div>
            </div>
            <div class="columns">
                <div class="column is-half">
                    <label class="label">Reply-To Address</label>
                    <p class="control">
                        <input class="input is-disabled" type="text" value="{{ $user->email }}" disabled>
                    </p>
                    <p class="help">Your email will be used when users reply to messages.</p>
                </div>
            </div>
            <div class="columns">
                <div class="column is-two-thirds">
                    @include('partials.textareaInput', ['name' => 'body', 'label' => 'Body', 'value' => $msg->body, 'required' => true])
                </div>
            </div>
            <div class="columns">
                <div class="column">
                    <div class="field">
                        <p class="control">
                            <input class="button is-light" name="preview" type="submit" v-is-loading="" value="Preview">
                        </p>
                        <p class="control">
                            Send yourself a preview of what the email looks like before it goes out to the group.
                        </p>
                    </div>
                </div>
            </div>
            <button class="button is-medium is-primary" type="submit" v-is-loading="">SEND</button>
        </form>
    </div>
</section>

@endsection

@include('partials.tinymce')
