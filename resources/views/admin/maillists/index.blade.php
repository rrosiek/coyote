@extends('admin.main')

@section('admin.body')

<div class="container is-fluid">
    @include('partials.notify')
    <div class="level">
        <div class="level-left">
            <p class="level-item">
                <a href="{{ route('maillists.create') }}" class="button is-primary">Add Mailing List</a>
            </p>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>No. of Members</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lists as $l)
            <tr>
                <td>{{ $l->name }}</td>
                <td>{{ $l->address }}</td>
                <td>{{ $l->members_count }}</td>
                <td>
                    <form action="{{ route('maillists.destroy', $l->address) }}" method="post">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <p class="control has-addons is-hover-visible">
                            <a href="{{ route('maillists.edit', ['address' => $l->address]) }}" class="button">Edit Members</a> 
                            <button class="button" type="submit">Delete</button>
                        </p>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection