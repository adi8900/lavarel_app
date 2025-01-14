<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <h1>Serwis Telefonów</h1>
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        &copy; 2025 Serwis Telefonów
    </footer>
</body>
</html>
