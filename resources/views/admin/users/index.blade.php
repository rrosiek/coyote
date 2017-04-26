@extends('admin.main')

@section('admin.body')

<div class="container is-fluid">
    @include('partials.notify')
    <div class="level">
        <div class="level-left">
            <div class="level-item">
                <div class="field">
                    <p class="control">
                        <button @click="showModal = true" class="button is-primary">Filter</button>
                    </p>
                </div>
            </div>
            @if (count(request()->all()) > 0)
                <div class="level-item">
                    <span class="tag is-dark is-medium">
                        Clear All
                        <a href="{{ route('users.index') }}" class="delete is-small"></a>
                    </span>
                </div>

                @foreach (request()->all() as $f => $val)
                    @if ($val)
                        <div class="level-item">
                            <span class="tag is-success is-medium">
                                {{ $f === 'filter' ? $val : ucwords($f) }}
                                <a href="{{ route('users.index', request()->except($f)) }}" class="delete is-small"></a>
                            </span>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
        <div class="level-right">
            <div class="level-item">
                @if (request('filter'))
                    {{ $users->appends(request()->all())->links() }}
                @else
                    {{ $users->links() }}
                @endif
            </div>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>E-Mail</th>
                <th>Updated</th>
                <th>Activated</th>
                <th>Subscribed to E-Mail</th>
                <th>Admin</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $u)
                <tr>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ $u->updated_at->diffForHumans() }}</td>
                    <td>
                        @if ($u->active)
                            <span class="tag is-success">Yes</span>
                        @else
                            <span class="tag is-dark">No</span>
                        @endif
                    </td>
                    <td>
                        @if ($u->subscribed)
                            <span class="tag is-success">Yes</span>
                        @else
                            <span class="tag is-dark">No</span>
                            @if ($u->email_failed)
                                Sending e-mail failed to this user and has been unsubscribed: {{ $u->email_failed }}
                            @endif
                        @endif
                    </td>
                    <td>
                        @if ($u->is_admin)
                            <span class="tag is-success">Yes</span>
                        @else
                            <span class="tag is-dark">No</span>
                        @endif
                    </td>
                    <td>
                        <p class="control has-addons is-hover-visible">
                            <a href="{{ route('users.edit', $u) }}" class="button">Edit</a>
                        </p>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@component('partials.modal')
    <form action="{{ route('users.index') }}" method="get" class="box">
        <h3 class="title is-3">Filters</h3>
        <div class="field">
            <p class="control">
                <input class="input" name="filter" placeholder="By Name or E-Mail" type="text" value="{{ request('filter', $default = null) }}">
            </p>
        </div>
        <div class="columns">
            <div class="column">
                @include('partials.checkboxInput', ['name' => 'inactive', 'label' => 'Inactive', 'value' => request('inactive', $default = false)])
            </div>
            <div class="column">
                @include('partials.checkboxInput', ['name' => 'unsubscribed', 'label' => 'Unsubscribed', 'value' => request('unsubscribed', $default = false)])
            </div>
            <div class="column">
                @include('partials.checkboxInput', ['name' => 'admin', 'label' => 'Administrators', 'value' => request('admin', $default = false)])
            </div>
        </div>
        <div class="field">
            <p class="control">
                <button class="button is-primary is-medium" type="submit" v-is-loading="">Save</button>
            </p>
        </div>
    </form>
@endcomponent

@endsection