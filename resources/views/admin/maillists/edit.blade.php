@extends('admin.main')

@section('admin.body')

<div class="container is-fluid">
    @include('partials.notify')
    <div class="columns">
        <div class="column is-one-third">
            <label class="label is-required">Member Email</label>
            <form class="field has-addons" action="{{ route('maillists.update', request('address')) }}" method="post">
                {{ method_field('PUT') }}
                {{ csrf_field() }}
                <p class="control is-expanded">
                    <input class="input" name="address" type="text" value="{{ old('address') }}">
                </p>
                <p class="control">
                    <button class="button is-primary" type="submit">
                        Add
                    </button>
                </p>
            </form>
            @if ($errors->has('address'))
                <span class="help is-danger">{{ $errors->first('address') }}</span>
            @endif
        </div>
    </div>
    <div class="columns">
        <div class="column is-one-third">
            <table class="table">
                <tbody>
                    @foreach ($members as $m)
                        <tr>
                            <td>{{ $m->address }}</td>
                            <td>
                                <p class="control has-addons is-hover-visible">
                                    <button class="button is-small is-danger is-outlined">Remove</button>
                                </p>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection