@extends('admin.main')

@section('admin.body')

<div class="container is-fluid">
    @include('partials.notify')
    <div class="level">
        <div class="level-left">
            <p class="level-item">
                <a href="{{ route('minutes.create') }}" class="button is-primary">Add Minutes</a>
            </p>
        </div>
        <div class="level-right">
            {{ $minutes->links() }}
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Meeting Date</th>
                <th>File Name</th>
                <th>Size</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($minutes as $m)
            <tr>
                <td>{{ $m->meeting_date->toFormattedDateString() }}</td>
                <td>{{ $m->upload->file_name }}</td>
                <td>{{ number_format($m->upload->size / 1024) }} KB</td>
                <td>
                    <form action="{{ route('minutes.destroy', $m) }}" method="post">
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