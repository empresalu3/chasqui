@extends('layouts.user')

@section('content')
<div class="container mt-4">
    <h2>{{ $aviso->titulo }}</h2>

    <div class="row">
        <div class="aviso-galeria">

    @if($aviso->imagenes->count() > 0)

        <div class="galeria-principal">
            <img id="imagenPrincipal" 
                 src="{{ asset($aviso->imagenes->first()->ruta) }}" 
                 alt="Imagen principal">
        </div>

        <div class="galeria-miniaturas">
            @foreach($aviso->imagenes as $img)
                <img src="{{ asset($img->ruta) }}" 
                     class="miniatura" 
                     onclick="cambiarImagen('{{ asset($img->ruta) }}')">
            @endforeach
        </div>

    @else
        <img src="{{ asset('images/no-image.png') }}" class="sin-imagen">
    @endif

</div>


        <div class="col-md-6">
            <p><strong>Categoría:</strong> {{ $aviso->categoria->nombre }}</p>
            <p><strong>Descripción:</strong> {{ $aviso->descripcion }}</p>
            <p><strong>Ubicación:</strong> {{ $aviso->ubicacion }}</p>
            <p><strong>Fecha de Publicación:</strong> {{ $aviso->created_at->format('d/m/Y H:i') }}</p>
            <p><strong> Telefono: </strong>{{$aviso->user->telefono}}</p>

            {{-- Campos dinámicos: solo si existen --}}
            @if($aviso->precio)
                <p><strong>Precio:</strong> S/ {{ number_format($aviso->precio, 2) }}</p>
            @endif

            @if($aviso->tipo_contrato)
                <p><strong>Tipo de Contrato:</strong> {{ $aviso->tipo_contrato }}</p>
            @endif

            @if($aviso->salario)
                <p><strong>Salario:</strong> S/ {{ number_format($aviso->salario, 2) }}</p>
            @endif

            @if($aviso->empresa)
                <p><strong>Empresa:</strong> {{ $aviso->empresa }}</p>
            @endif

            @if($aviso->requisitos)
                <p><strong>Requisitos:</strong> {{ $aviso->requisitos }}</p>
            @endif

            @if($aviso->estado_producto)
                <p><strong>Estado del Producto:</strong> {{ $aviso->estado_producto }}</p>
            @endif

            @if($aviso->fecha_inicio)
                <p><strong>Fecha Inicio:</strong> {{ \Carbon\Carbon::parse($aviso->fecha_inicio)->format('d/m/Y H:i') }}</p>
            @endif

            @if($aviso->fecha_fin)
                <p><strong>Fecha Fin:</strong> {{ \Carbon\Carbon::parse($aviso->fecha_fin)->format('d/m/Y H:i') }}</p>
            @endif

            @if($aviso->organizador)
                <p><strong>Organizador:</strong> {{ $aviso->organizador }}</p>
            @endif

            @if($aviso->capacidad)
                <p><strong>Capacidad:</strong> {{ $aviso->capacidad }}</p>
            @endif

            <p><strong>Publicado por:</strong> {{ $aviso->user->name }}</p>
            <p><strong>Estado:</strong> {{ ucfirst($aviso->estado_publicacion) }}</p>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('user.avisos.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</div>
<script>
function cambiarImagen(ruta) {
    document.getElementById('imagenPrincipal').src = ruta;
}
</script>

@endsection
