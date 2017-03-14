@extends('layouts.main')

@section('body')

@include('partials.nav')
@include('partials.title')

<section class="section">
    <div class="container is-fluid">
        @include('partials.notify')
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
                    <th>Details</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $e)
                    <tr>
                        <td>{{ $e->title }}</td>
                        <td>{{ $e->detail }}</td>
                        <td>
                            <form
                                action="{{ route('events.destroy', ['event' => $e->id]) }}"
                                method="post"
                            >
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <p class="control has-addons is-hover-visible">
                                    <a href="{{ route('events.edit', ['event' => $e->id]) }}" class="button">Edit</a>
                                    <button class="button" type="submit">Remove</button>
                                </p>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

@endsection