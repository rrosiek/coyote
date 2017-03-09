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
    @if(isset($subnav))
        <div class="hero-footer">
            <div class="container is-fluid">
                <nav class="tabs is-boxed">
                    <ul>
                        @foreach($subnav as $nav)
                            <li>
                                <a href="{{ $nav['link'] }}">{{ $nav['label'] }}</a>
                            </li>
                        @endforeach
                    </ul>
                </nav>
            </div>
        </div>
    @endif
</section>
