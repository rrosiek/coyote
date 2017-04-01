<section class="hero is-light is-bold is-medium" id="brothers">
    <div class="hero-body">
        <div class="container">
            <div class="columns">
                <div class="column has-text-centered is-hidden-touch">
                    <figure class="image is-4by3">
                        <img src="{{ $data['image_public_path'] }}">
                    </figure>
                </div>
                <div class="column">
                    <h1 class="title is-styled">{{ $data['title'] }}</h1>
                    {!! $data['snippet'] !!}
                    <br>
                    <div class="has-text-right">
                        <a href="/brothers" class="button is-primary is-outlined">Read More</a>
                    </div>
                </div>
                <div class="column has-text-centered is-hidden-desktop">
                    <figure class="image is-4by3">
                        <img src="{{ $data['image_public_path'] }}">
                    </figure>
                </div>
            </div>
        </div>
    </div>
</section>
