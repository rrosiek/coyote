<div class="container">
    <div class="level">
        <div class="level-left">
            <div class="level-item">
                <div class="field">
                    <p class="control">
                        <a href="{{ route('profiles.index') }}" class="button is-primary">Back</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="level-right">
            <div class="level-item">
                {{ $profiles->appends(request()->all())->links() }}
            </div>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>E-Mail</th>
                <th>Address</th>
                <th>Phone</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($profiles as $p)
                <tr>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->email }}</td>
                    <td>{{ $p->full_address }}</td>
                    <td>{{ $p->phone }}</td>
                    <td>
                        <p class="control has-addons is-hover-visible">
                            <button @click="$bus.$emit('showProfileDetails', {{ $p->id }})" class="button">Details</button>
                        </p>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<profile-details></profile-details>
