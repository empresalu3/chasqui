@extends('layouts.user')

@section('content')
<div class="container">
    <h2>Resultados para: "{{ $query }}"</h2>

    <div class="avisos-grid">
        @forelse($avisos as $aviso)
            <div class="aviso-card">
                <div class="aviso-img">
                    @if($aviso->imagenes->count())
                        <img src="{{ asset($aviso->imagenes->first()->ruta) }}" alt="">
                    @else
                        <img src="{{ asset('images/no-image.png') }}" alt="">
                    @endif
                </div>

                <div class="aviso-info">
                    <h3>{{ $aviso->titulo }}</h3>
                    <p class="desc">{{ Str::limit($aviso->descripcion, 80) }}</p>
                    <p class="precio">S/ {{ number_format($aviso->precio, 2) }}</p>
                    <p class="ubicacion">📍 {{ $aviso->ubicacion }}</p>

                    <a href="{{ route('user.avisos.show', $aviso->id) }}" class="btn-ver">
                        Ver más
                    </a>
                </div>
            </div>
        @empty
            <p>No se encontraron resultados </p>
        @endforelse
    </div>

    <div class="pagination">
        {{ $avisos->links() }}
    </div>
</div>
@endsection
