@extends('admin.main')

@section('admin.body')

<div class="container is-fluid">
    @include('partials.notify')
    <div class="level">
        <div class="level-left">
            <form action="{{ route('users.index') }}" method="get" class="level-item">
                <div class="field has-addons">
                    <p class="control">
                        <input class="input" name="filter" placeholder="Name or E-Mail" type="text" value="{{ request('filter', $default = null) }}">
                    </p>
                    <p class="control">
                        <button class="button is-primary" type="submit">Filter</button>
                    </p>
                    <p class="control">
                        <a href="{{ route('users.index') }}" class="button">Clear</a>
                    </p>
                </div>
            </form>
        </div>
        <div class="level-right">
            <div class="level-item">
                @if (request('filter'))
                    {{ $users->appends(['filter' => request('filter')])->links() }}
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
                <th>Zip Code</th>
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
                    <td>{{ $u->zip }}</td>
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

@endsection