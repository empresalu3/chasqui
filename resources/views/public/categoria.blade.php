@extends('layouts.user')

@section('content')
<div class="container">
    <h2>Avisos en "{{ $categoriaNombre }}"</h2>

    <div class="avisos-grid">
        @foreach($avisos as $aviso)
            <div class="aviso-card">
                <div class="aviso-img">
                    @if($aviso->imagenes->count() > 0)
                        <img src="{{ asset($aviso->imagenes->first()->ruta) }}" alt="Imagen del aviso">
                    @else
                        <img src="{{ asset('images/no-image.png') }}" alt="Sin imagen">
                    @endif
                </div>
                <div class="aviso-info">
                    <h3>{{ $aviso->titulo }}</h3>
                    <p class="desc">{{ Str::limit($aviso->descripcion, 80) }}</p>
                    <p class="precio">S/ {{ number_format($aviso->precio, 2) }}</p>
                    <p class="ubicacion">📍 {{ $aviso->ubicacion }}</p>
                    <a href="{{ route('user.avisos.show', $aviso->id) }}" class="btn-ver">Ver más</a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="pagination">
        {{ $avisos->links() }}
    </div>
</div>
@endsection
