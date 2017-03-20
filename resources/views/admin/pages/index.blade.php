@extends('admin.main')

@section('admin.body')

<div class="container is-fluid">
    @include('partials.notify')
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Details</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <p class="control has-addons is-hover-visible">
                        <a href="" class="button">Edit</a>
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
</div>

@endsection