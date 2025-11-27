<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Chasqui Express - Acceso')</title>

    @vite('resources/css/user.css')
</head>
<body class="auth-body">

    <main class="auth-container">
        @yield('content')
    </main>

</body>
</html>
