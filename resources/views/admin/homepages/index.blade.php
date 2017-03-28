@extends('admin.main')

@section('admin.body')

<div class="container is-fluid">
    @include('partials.notify')
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Slug</th>
                <th>Updated By</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pages as $p)
            <tr>
                <td>{{ $p->title }}</td>
                <td>{{ $p->slug }}</td>
                <td>{{ $p->updated_by }}</td>
                <td>
                    <p class="control has-addons is-hover-visible">
                        <a href="{{ route('home-pages.edit', ['homePage' => $p->id]) }}" class="button">Edit</a>
                    </p>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection