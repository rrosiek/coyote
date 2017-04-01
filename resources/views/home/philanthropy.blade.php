<section class="hero is-warning is-bold is-medium" id="philanthropy">
    <div class="hero-body">
        <div class="container">
            <div class="columns">
                <div class="column">
                    <h1 class="title is-styled">{{ $data['title'] }}</h1>
                    {!! $data['snippet'] !!}
                    <br>
                    <div>
                        <a href="/philanthropy" class="button is-dark is-outlined">Read More</a>
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
