<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    @include('partials.header')

    <div class="content">
        @yield('content')
    </div>

    <footer>
        <p>&copy; {{ date('Y') }} - MMI3 Dev - ESTRADE Simon</p>
    </footer>
</body>
</html>