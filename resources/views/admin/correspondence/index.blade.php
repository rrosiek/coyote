@extends('admin.main')

@section('admin.body')

<div class="container is-fluid">
    @include('partials.notify')
    <div class="level">
        <div class="level-left">
            <p class="level-item">
                <a href="{{ route('correspondence.create') }}" class="button is-primary">New Message</a>
            </p>
        </div>
        <div class="level-right">
            <div class="level-item">
                {{ $messages->links() }}
            </div>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Subject</th>
                <th>Author</th>
                <th>Opens</th>
                <th>Failures</th>
                <th>Deliveries</th>
                <th>Created</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($messages as $m)
                <tr>
                    <td>{{ $m->subject }}</td>
                    <td>{{ $m->author->name }}</td>
                    <td>{{ $m->opens }}</td>
                    <td>{{ count(json_decode($m->failures) ?? []) }}</td>
                    <td>{{ $m->deliveries }}</td>
                    <td>{{ $m->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection