<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Weather IUT - Dashboard</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <link rel="stylesheet" href="resources/css/app.css">
        </head>
    <body>
        <div>
            <h1>Dashboard</h1>
            <a href="{{ route('places') }}">Go to Places</a>
            <a href="{{ route('profil') }}">Go to your profil</a>
        </div>
    </body>
</html>
