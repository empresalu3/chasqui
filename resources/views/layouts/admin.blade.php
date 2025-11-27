<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel de Administración - Chasqui Express')</title>
    @vite('resources/css/admin.css')
</head>
<body class="admin-body">

    {{-- Header del admin --}}
    @include('partials.admin-header')

    <div class="admin-layout">
        {{-- Sidebar --}}
        <div class="dashboard-layout">
        @include('partials.admin-sidebar')
        
        {{-- Contenido principal --}}
        <main class="admin-content">
            @yield('content')
        </main>
        </div>
    </div>

    {{-- Footer --}}
    @include('partials.admin-footer')

</body>
</html>
