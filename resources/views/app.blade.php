<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Works for Good</title>
    <!-- <meta name="description" content="Placeholder"> -->
    <meta name="author" content="Nick Dragunow">

    <meta property="og:title" content="Works for Good">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.worksforgood.info">
    <!-- <meta property="og:description" content="Placeholder"> -->
    <!-- <meta property="og:image" content="placeholder.png"> -->

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-YP8MR3WZC9"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-YP8MR3WZC9');
    </script>
    
    <link rel="icon" href="/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/app.webmanifest">

    @routes
    <link href="{{ asset(mix('css/app.css')) }}" rel="stylesheet">
    <script src="{{ asset(mix('js/manifest.js')) }}" defer></script>
    <script src="{{ asset(mix('js/vendor.js')) }}" defer></script>
    <script src="{{ asset(mix('js/app.js')) }}" defer></script>
    @inertiaHead

</head>

<body>
    @inertia
</body>

</html>