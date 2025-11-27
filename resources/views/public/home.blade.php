@extends('layouts.user')

@section('title', 'Chasqui Express | Clasificados de Ayacucho')
@section('meta_description', 'Publica empleo, alquileres, compra/venta, servicios y eventos en Ayacucho. Encuentra oportunidades cerca de ti.')


@section('content')

    {{-- Banner --}}
    <div class="banner">
        <div class="banner-content">
            <h2>¡Publica tu anuncio GRATIS!</h2>
            <p>Encuentra empleo, vende o alquila. Miles de personas te están buscando</p>
            <a href="{{ route('user.avisos.create') }}" class="banner-btn">Publicar Ahora</a>
        </div>
        <div class="banner-image">📱</div>
    </div>



    @if($destacados->count())
<div class="avisos-container">
    <h2 class="title">Avisos Destacados</h2>

    <div class="avisos-grid">
        @foreach($destacados as $aviso)
            <div class="aviso-card">
                <div class="aviso-img">
                    @if($aviso->imagenes->count())
                        <img src="{{ asset($aviso->imagenes->first()->ruta) }}" alt="Imagen del aviso">
                    @else
                        <img src="{{ asset('images/no-image.png') }}" alt="Sin imagen">
                    @endif
                </div>

                <div class="aviso-info">
                    <h3>{{ $aviso->titulo }}</h3>

                    <p class="desc">{{ Str::limit($aviso->descripcion, 80) }}</p>

                    @if($aviso->precio)
                        <p class="precio">S/ {{ number_format($aviso->precio, 2) }}</p>
                    @endif

                    <p class="categoria">{{ $aviso->categoria->nombre ?? 'Sin categoría' }}</p>
                    <p class="ubicacion">📍 {{ $aviso->ubicacion }}</p>
                    <p class="publicado">👤 {{ $aviso->user->name }}</p>

                    <a href="{{ route('user.avisos.show', $aviso->id) }}" class="view-all">
                        Ver más
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endif


    {{-- Recientes --}}
    <div class="avisos-container">
    <h2 class="title">Avisos Recientes</h2>

    @if($recientes->count())
        <div class="avisos-grid">
            @foreach($recientes as $aviso)
                <div class="aviso-card">

                    <div class="aviso-img">
                        @if($aviso->imagenes->count())
                            <img src="{{ asset($aviso->imagenes->first()->ruta) }}" alt="Imagen del aviso">
                        @else
                            <img src="{{ asset('images/no-image.png') }}" alt="Sin imagen">
                        @endif
                    </div>

                    <div class="aviso-info">
                        <h3>{{ $aviso->titulo }}</h3>

                        <p class="desc">{{ Str::limit($aviso->descripcion, 80) }}</p>

                        @if($aviso->precio)
                            <p class="precio">S/ {{ number_format($aviso->precio, 2) }}</p>
                        @endif

                        <p class="categoria">{{ $aviso->categoria->nombre ?? 'Sin categoría' }}</p>
                        <p class="ubicacion">📍 {{ $aviso->ubicacion }}</p>
                        <p class="publicado">👤 {{ $aviso->user->name }}</p>

                        <a href="{{ route('user.avisos.show', $aviso->id) }}" class="view-all">
                            Ver más
                        </a>
                    </div>

                </div>
            @endforeach
        </div>
    @else
        <p>No hay avisos disponibles por el momento</p>
    @endif
</div>


@endsection
