@extends('layouts.user')

@section('title', 'Inicio - Chasqui Express')

@section('content')
{{--<h1>Bienvenido, {{ Auth::user()->name }}</h1>
    <p>Este es tu panel de usuario.</p>
     Banner href="{{ route('avisos.create') }}" --}}
    <div class="banner">
        <div class="banner-content">
            <h2>¡Publica tu anuncio GRATIS!</h2>
            <p>Encuentra empleo, vende o alquila. Miles de personas te están buscando</p>
            <a  class="banner-btn">Publicar Ahora</a>
        </div>
        <div class="banner-image">📱</div>
    </div>

    {{-- Categories href="{{ route('categorias.index') }}"--}}
    <div class="section">
        <div class="section-header">
            <h2 class="section-title">Explora por Categoría</h2>
            <a  class="view-all">Ver todas →</a>
        </div>

        <div class="categories-grid">
            {{-- Ejemplo estático: luego lo llenamos con @foreach($categorias) --}}
            <div class="category-card">
                <div class="category-icon">💼</div>
                <div class="category-title">Empleos</div>
                <div class="category-count">328 ofertas activas</div>
            </div>
            <div class="category-card">
                <div class="category-icon">🏠</div>
                <div class="category-title">Inmuebles</div>
                <div class="category-count">156 propiedades</div>
            </div>
            <div class="category-card">
                <div class="category-icon">🚗</div>
                <div class="category-title">Vehículos</div>
                <div class="category-count">89 vehículos</div>
            </div>
            <div class="category-card">
                <div class="category-icon">🎭</div>
                <div class="category-title">Agenda Cultural</div>
                <div class="category-count">45 eventos próximos</div>
            </div>
        </div>
    </div>

    {{-- Listings (ejemplo estático)href="{{ route('avisos.index') }}" --}}
    <div class="section">
        <div class="section-header">
            <h2 class="section-title">Publicaciones Recientes</h2>
            <a  class="view-all">Ver más →</a>
        </div>

        <div class="listings-grid">
            {{-- ejemplo fijo; luego reemplazamos con bucle --}}
            <div class="listing-card">
                <div class="listing-image">💼</div>
                <div class="listing-content">
                    <div class="listing-title">Asistente Administrativo</div>
                    <div class="listing-price">S/ 1,500 - S/ 2,000</div>
                    <div class="listing-location">📍 Centro de Ayacucho</div>
                    <span class="listing-badge">NUEVO</span>
                </div>
            </div>
            <!-- más cards... -->
        </div>
    </div>
@endsection
