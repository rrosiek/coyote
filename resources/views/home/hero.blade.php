<section class="hero is-fullheight is-landing" id="home">
    <div class="hero-head">
        @include('partials.nav')
    </div>
    <div class="hero-body">
        <div class="container has-text-centered">
            <div class="columns is-hidden-mobile">
                <div class="column is-4 is-offset-4">
                    <figure class="image is-square has-text-centered">
                        <img src="/images/crest.png" title="Crest">
                    </figure>
                </div>
            </div>
            <div class="columns">
                <div class="column">
                    <h2 class="is-styled">Friendship</h2>
                </div>
                <div class="column">
                    <h2 class="is-styled">Justice</h2>
                </div>
                <div class="column">
                    <h2 class="is-styled">Learning</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-footer">
        <div class="container has-text-centered">
            <div class="columns">
                @foreach ($events as $e)
                    <div class="column">
                        <h4 class="is-styled">{{ $e['title'] }}</h4>
                        @if ($e['allDay'])
                            <h5><strong>{{ $e['start']->format('F jS') }}</strong></h5>
                        @else
                            <h5><strong>{{ $e['start']->format('F jS, g:ia') }}</strong> for {{ $e['end'] }}</h5>
                        @endif
                    </div>
                @endforeach
            </div>
            <div class="columns">
                <div class="column">
                    <a class="button is-primary" href="{{ route('events.list') }}">Other Events</a>
                </div>
            </div>
            <div>
                <i class="icon is-medium fa fa-angle-down"></i>
            </div>
        </div>
    </div>
</section>
