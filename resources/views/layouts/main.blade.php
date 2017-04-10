<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sigma Chi Iota Zeta :: {{ $title or '' }}</title>

        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=IM+Fell+English+SC:400" rel="stylesheet" type="text/css">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
        <link href="/css/app.css" rel="stylesheet">

        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="/manifest.json">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="theme-color" content="#ffffff">

        <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token()]) !!}</script>
        <script>window.Laravel = {!! json_encode(['stripeKey' => env('STRIPE_KEY')]) !!}</script>
    </head>

    <body>

    <div id="app">

    @yield('body')

    </div>

    </body>

    <script src="https://js.stripe.com/v3/"></script>
    <script src="/js/app.js"></script>
</html>
