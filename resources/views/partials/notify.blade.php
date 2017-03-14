@if(session('successMsg'))
    <div class="notification is-success">
        <button class="delete" v-notify-close=""></button>
        {{ session('successMsg') }}
    </div>
@endif

@if(session('errorMsg'))
    <div class="notification is-danger">
        <button class="delete" v-notify-close=""></button>
        {{ session('errorMsg') }}
    </div>
@endif

@if(session('warnMsg'))
    <div class="notification is-warning">
        <button class="delete" v-notify-close=""></button>
        {{ session('warnMsg') }}
    </div>
@endif