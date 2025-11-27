<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Chasqui Express')</title>

    {{-- Estilos comunes (Bootstrap o Tailwind) --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100">
    @yield('content')

    {{-- Scripts globales --}}
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
