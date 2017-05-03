@extends('admin.main')

@section('admin.body')

<div class="container is-fluid">
    @include('partials.notify')
    <div class="level">
        <div class="level-left">
            <p class="level-item">
                <a href="{{ route('files.create') }}" class="button is-primary">Add File</a>
            </p>
        </div>
        <div class="level-right">
            {{ $files->links() }}
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Label / Description</th>
                <th>File Name</th>
                <th>Size</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($files as $f)
            <tr>
                <td>{{ $f->description }}</td>
                <td>{{ $f->upload->file_name }}</td>
                <td>{{ number_format($f->upload->size / 1024) }} KB</td>
                <td>
                    <form action="{{ route('files.destroy', $f) }}" method="post">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <p class="control has-addons is-hover-visible">
                            <a href="{{ route('files.show', ['token' => $f->upload->token]) }}" class="button">Download</a>
                            <a class="button" v-clipboard="{ text: '{{ route('files.show', ['token' => $f->upload->token]) }}' }">
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