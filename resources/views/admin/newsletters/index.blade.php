@extends('admin.main')

@section('admin.body')

<div class="container is-fluid">
    @include('partials.notify')
    <div class="level">
        <div class="level-left">
            <p class="level-item">
                <a href="{{ route('newsletters.create') }}" class="button is-primary">Add Newsletter</a>
            </p>
        </div>
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
                    <form action="{{ route('newsletters.destroy', $n) }}" method="post">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <p class="control has-addons is-hover-visible">
                            <a href="{{ route('newsletters.show', ['token' => $n->upload->token]) }}" class="button">Download</a>
                            <a class="button" v-clipboard="{ text: '{{ route('newsletters.show', ['token' => $n->upload->token]) }}' }">
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