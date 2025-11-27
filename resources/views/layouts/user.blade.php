<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- SEO GENERAL -->
<title>@yield('title', 'Chasqui Express')</title>

<meta name="description" content="@yield('meta_description', 'Publica y encuentra empleos, alquileres, compra/venta, servicios y eventos en Ayacucho y el Perú. Anuncios aprobados y verificados.')">
<meta name="keywords" content="clasificados Ayacucho, empleo Ayacucho, alquileres, compra venta, servicios, eventos, chasqui express, anuncios Perú">

<meta name="author" content="Chasqui Express">
<meta name="robots" content="index, follow">
<meta name="language" content="es">
<meta name="geo.region" content="PE-AYA">
<meta name="geo.placename" content="Ayacucho">

<!-- TWITTER CARDS -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="@yield('title', 'Chasqui Express')">
<meta name="twitter:description" content="@yield('meta_description', 'Clasificados de Ayacucho')">
<meta name="twitter:image" content="{{ asset('images/meta-image.jpg') }}">

<!-- OPEN GRAPH PARA FACEBOOK / WHATSAPP -->
<meta property="og:title" content="@yield('title', 'Chasqui Express')">
<meta property="og:description" content="@yield('meta_description', 'Clasificados en Ayacucho')">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:image" content="{{ asset('images/meta-image.jpg') }}">
<meta property="og:locale" content="es_PE">

<!-- FAVICON -->
<link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

<!-- Google verification (si lo necesitas en Search Console) -->
{{-- <meta name="google-site-verification" content="TU-CODIGO"> --}}



    @vite('resources/css/user.css')
</head>
<body>
    @include('partials.user-header')
    @include('partials.user-nav')

    <main class="container">
        @yield('content')
    </main>

    @include('partials.user-footer')
</body>
</html>
