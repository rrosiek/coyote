<nav class="nav">
    <div class="nav-left">
        <a href="/" class="nav-item">
            <h4 class="is-styled is-primary">Sigma Chi Iota Zeta</h4>
        </a>
    </div>

    <span class="nav-toggle">
        <span></span>
        <span></span>
        <span></span>
    </span>

    <div class="nav-right nav-menu">
        @if (Route::currentRouteName() === 'home')
            <a class="nav-item" v-scroll-to="{ id: 'aboutus' }">
                ABOUT US
            </a>
            <a class="nav-item" v-scroll-to="{ id: 'brothers' }">
                BROTHERS
            </a>
            <a class="nav-item" v-scroll-to="{ id: 'philanthropy' }">
                PHILANTHROPY
            </a>
            <a class="nav-item" v-scroll-to="{ id: 'pledging' }">
                PLEDGING
            </a>
        @else
            <a class="nav-item" href="/">HOME</a>
            <a class="nav-item" href="/">PAYMENTS</a>
        @endif
        @if (Auth::check())
            <a class="nav-item" href="/">PROFILE</a>
            <a class="nav-item" href="/">DIRECTORY</a>
            @if (Auth::user()->is_admin)
                <a class="nav-item" href="/admin">ADMIN</a>
            @endif
        @else
            <a class="nav-item" href="/members">MEMBERS</a>
        @endif
        <a href="https://www.facebook.com/groups/71074270336/" class="nav-item">
            <span class="icon">
                <i class="fa fa-facebook"></i>
            </span>
        </a>
        <a href="https://github.com/rrosiek/coyote" class="nav-item">
            <span class="icon">
                <i class="fa fa-github"></i>
            </span>
        </a>
    </div>
</nav>