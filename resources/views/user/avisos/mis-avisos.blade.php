@extends('layouts.user')

@section('content')
<div class="container">
    <h2>Mis Avisos Publicados</h2>

    <div class="avisos-grid">
        @forelse($avisos as $aviso)
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
                    <p class="estado">
                        Estado: 
                        <strong style="color: 
                            {{ $aviso->estado_publicacion === 'pendiente' ? 'orange' : 'green' }}">
                            {{ ucfirst($aviso->estado_publicacion) }}
                        </strong>
                    </p>
                    <a href="{{ route('user.avisos.show', $aviso->id) }}" class="btn-ver">Ver más</a>
                    <a href="{{ route('user.avisos.edit', $aviso->id) }}" class="btn-editar">Editar</a>
                    <form action="{{ route('user.avisos.destroy', $aviso->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-eliminar" 
                            onclick="return confirm('¿Estás seguro de eliminar este aviso?');">
                            Eliminar
                        </button>
                </div>
            </div>
        @empty
            <p>No tienes avisos publicados aún.</p>
        @endforelse
    </div>
    

    <div class="pagination">
        {{ $avisos->links() }}
    </div>
</div>
@endsection
