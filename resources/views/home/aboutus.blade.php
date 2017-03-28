<section class="hero is-primary is-bold is-medium" id="aboutus">
    <div class="hero-body">
        <div class="container">
            <div class="columns">
                <div class="column">
                    <h1 class="title is-styled">{{ $data['title'] }}</h1>
                    <p class="content is-light">{{ $data['snippet'] }}</p>
                    <div>
                        <a href="/about-us" class="button is-primary is-inverted is-outlined">Read More</a>
                    </div>
                </div>
                <div class="column has-text-centered">
                    <figure class="image is-4by3">
                        <img src="{{ $data['image_public_path'] }}">
                    </figure>
                </div>
            </div>
        </div>
    </div>
</section>
