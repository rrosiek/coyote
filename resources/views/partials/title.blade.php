<section class="hero is-primary is-badged">
    <div class="hero-body">
        <div class="container is-fluid">
            <h1 class="title">
                {{ $title }}
            </h1>
            @if(isset($subtitle))
                <h2 class="subtitle">
                    {{ $subtitle }}
                </h2>
            @endif
        </div>
    </div>
</section>
