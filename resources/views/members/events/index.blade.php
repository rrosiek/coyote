@extends('layouts.main')

@section('body')

@include('partials.nav')
@include('partials.title')

<section class="section">
    <div class="container is-fluid">
        <div class="level">
            <div class="level-left">
                <p class="level-item">
                    <a href="{{ route('events.create') }}" class="button is-medium is-primary">
                        <span class="icon">
                            <i class="fa fa-plus"></i>
                        </span>
                    </a>
                </p>
            </div>
            <div class="level-right">
                {{ $events->links() }}
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $e)
                    <tr>
                        <td>{{ $e->title }}</td>
                        <td>{{ $e->description }}</td>
                        <td>
                            <p class="control has-addons">
                                <a class="button">Edit</a>
                                <a class="button">
                                    <span class="icon is-small">
                                        <i class="fa fa-arrows"></i>
                                    </span>
                                </a>
                                <a class="button is-danger">
                                    <span class="icon is-small">
                                        <i class="fa fa-close"></i>
                                    </span>
                                </a>
                            </p>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

@endsection