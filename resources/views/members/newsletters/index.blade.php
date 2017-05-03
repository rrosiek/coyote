@extends('members.main')

@section('members.body')

<div class="container is-fluid">
    <div class="level">
        <div class="level-right">
            {{ $newsletters->links() }}
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Name / Label</th>
                <th>File Name</th>
                <th>Size</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($newsletters as $n)
            <tr>
                <td>{{ $n->name }}</td>
                <td>{{ $n->upload->file_name }}</td>
                <td>{{ number_format($n->upload->size / 1024) }} KB</td>
                <td>
                    <p class="control has-addons is-hover-visible">
                        <a href="{{ route('newsletters.show', ['token' => $n->upload->token]) }}" class="button">Download</a>
                        <a class="button" v-clipboard="{ text: '{{ route('newsletters.show', ['token' => $n->upload->token]) }}' }">
                            Copy URL
                        </a>
                    </p>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection