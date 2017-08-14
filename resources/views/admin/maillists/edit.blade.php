@extends('admin.main')

@section('admin.body')

<div class="container is-fluid">
    @include('partials.notify')
    <form action="{{ route('maillists.update', $maillist) }}" method="post">
        <div class="columns">
            <div class="column is-one-third">
                {{ method_field('PUT') }}
                {{ csrf_field() }}
                @include('partials.textareaInput', ['name' => 'members', 'label' => 'Members', 'value' => '', 'required' => true])
                <p class="help">Enter one email address per line.</p>
            </div>
        </div>
        <button class="button is-primary" type="submit" v-is-loading="">Add Addresses</button>
    </form>
    <hr>
    <div class="columns">
        <div class="column is-one-third">
            <table class="table">
                <tbody>
                    @foreach ($members as $m)
                        <tr>
                            <td>{{ $m->address }}</td>
                            <td>
                                <form action="{{ route('maillists.destroy', $maillist) }}" method="post">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_address" value="{{ $m->address }}">
                                    <p class="control has-addons is-hover-visible">
                                        <button class="button is-small is-danger is-outlined" type="submit" v-is-loading="">Delete</button>
                                    </p>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection