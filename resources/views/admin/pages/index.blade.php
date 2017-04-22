@extends('admin.main')

@section('admin.body')

<div class="container is-fluid">
    @include('partials.notify')
    <div class="level">
        <div class="level-left">
            <p class="level-item">
                <a href="{{ route('pages.create') }}" class="button is-primary">Add Page</a>
            </p>
        </div>
        <div class="level-right">
            {{ $pages->links() }}
        </div>
    </div>
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
                    <form action="{{ route('pages.destroy', $p) }}" method="post">
                        <p class="control has-addons is-hover-visible">
                            <a href="{{ route('pages.edit', $p) }}" class="button">Edit</a>
                            @if (!$p->home_page)
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}

                                    <button class="button" type="submit">Delete</button>
                            @endif
                        </p>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection