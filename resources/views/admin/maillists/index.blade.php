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
                <th>Description</th>
                <th>Address</th>
                <th>No. of Members</th>
                <th>Created</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lists as $l)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <form action="{{ route('maillists.destroy', $l) }}" method="post">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <p class="control has-addons is-hover-visible">
                            <a href="{{ route('minutes.show', ['token' => $m->upload->token]) }}" class="button">Download</a>
                            <a class="button" v-clipboard="{ text: '{{ route('minutes.show', ['token' => $m->upload->token]) }}' }">
                                Copy URL
                            </a>
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