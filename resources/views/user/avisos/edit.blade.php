@extends('layouts.user')

@section('content')

<div class="container">
    <h2>Editar Aviso</h2>

    <form action="{{ route('user.avisos.update', $aviso->id) }}"
          method="POST" enctype="multipart/form-data" id="formAviso">
        @csrf
        @method('PUT')

        <!-- Categoría -->
        <div class="mb-3">
            <label for="categoria_id">Categoría</label>
            <select name="categoria_id" id="categoria_id" class="form-control" required>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" 
                        data-tipo="{{ strtolower($categoria->nombre) }}"
                        @selected($categoria->id == $aviso->categoria_id)>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Título -->
        <div class="mb-3">
            <label>Título</label>
            <input type="text" name="titulo" class="form-control"
                   value="{{ $aviso->titulo }}" required>
        </div>

        <!-- Descripción -->
        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="descripcion" class="form-control" rows="3" required>
                {{ $aviso->descripcion }}
            </textarea>
        </div>

        <div class="mb-3">
            <label>Ubicación</label>
            <input type="text" name="ubicacion" class="form-control"
                   value="{{ $aviso->ubicacion }}">
        </div>

        <!-- Campos extra (plantilla JS) -->
        <div id="camposExtra"></div>

        <!-- Imágenes actuales -->
        <h4>Imágenes actuales</h4>
        <div class="row">
            @foreach($aviso->imagenes as $img)
                <div class="col-3 mb-3">
                    <img src="{{ asset($img->ruta) }}" class="img-fluid rounded">
                </div>
            @endforeach
        </div>

        <!-- Subir imágenes nuevas -->
        <div class="mb-3">
            <label>Nuevas imágenes (opcional)</label>
            <input type="file" name="imagenes[]" multiple class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {

    const categoriaSelect = document.getElementById('categoria_id');
    const camposExtra = document.getElementById('camposExtra');

    // Traemos los valores del aviso desde Blade (ya renderizados):
    const datosAviso = {
        tipo_contrato: @json($aviso->tipo_contrato),
        salario: @json($aviso->salario),
        empresa: @json($aviso->empresa),
        requisitos: @json($aviso->requisitos),
        precio: @json($aviso->precio),
        estado_producto: @json($aviso->estado_producto),
        fecha_inicio: @json($aviso->fecha_inicio),
        fecha_fin: @json($aviso->fecha_fin),
        organizador: @json($aviso->organizador),
        capacidad: @json($aviso->capacidad)
    };

    // Plantillas dinámicas con valores precargados
    function getPlantilla(tipo) {
        const plantillas = {
            'empleos': `
                <div class="mb-3"><label>Tipo de Contrato</label>
                    <input type="text" name="tipo_contrato" class="form-control"
                           value="${datosAviso.tipo_contrato ?? ''}">
                </div>

                <div class="mb-3"><label>Salario</label>
                    <input type="number" name="salario" class="form-control"
                           value="${datosAviso.salario ?? ''}">
                </div>

                <div class="mb-3"><label>Empresa/Empleador</label>
                    <input type="text" name="empresa" class="form-control"
                           value="${datosAviso.empresa ?? ''}">
                </div>

                <div class="mb-3"><label>Requisitos</label>
                    <textarea name="requisitos" class="form-control">${datosAviso.requisitos ?? ''}</textarea>
                </div>
            `,

            'compra/venta': `
                <div class="mb-3"><label>Precio</label>
                    <input type="number" name="precio" class="form-control"
                           value="${datosAviso.precio ?? ''}">
                </div>

                <div class="mb-3"><label>Estado del Producto</label>
                    <input type="text" name="estado_producto" class="form-control"
                           value="${datosAviso.estado_producto ?? ''}">
                </div>
            `,

            'alquileres': `
                <div class="mb-3"><label>Precio</label>
                    <input type="number" name="precio" class="form-control"
                           value="${datosAviso.precio ?? ''}">
                </div>
            `,

            'eventos': `
                <div class="mb-3"><label>Precio</label>
                    <input type="number" name="precio" class="form-control"
                           value="${datosAviso.precio ?? ''}">
                </div>

                <div class="mb-3"><label>Fecha Inicio</label>
                    <input type="datetime-local" name="fecha_inicio" class="form-control"
                           value="${datosAviso.fecha_inicio ?? ''}">
                </div>

                <div class="mb-3"><label>Fecha Fin</label>
                    <input type="datetime-local" name="fecha_fin" class="form-control"
                           value="${datosAviso.fecha_fin ?? ''}">
                </div>

                <div class="mb-3"><label>Organizador</label>
                    <input type="text" name="organizador" class="form-control"
                           value="${datosAviso.organizador ?? ''}">
                </div>

                <div class="mb-3"><label>Capacidad</label>
                    <input type="number" name="capacidad" class="form-control"
                           value="${datosAviso.capacidad ?? ''}">
                </div>
            `,

            'servicios': `
                <div class="mb-3"><label>Fecha Inicio</label>
                    <input type="date" name="fecha_inicio" class="form-control"
                           value="${datosAviso.fecha_inicio ?? ''}">
                </div>

                <div class="mb-3"><label>Fecha Fin</label>
                    <input type="date" name="fecha_fin" class="form-control"
                           value="${datosAviso.fecha_fin ?? ''}">
                </div>

                <div class="mb-3"><label>Organizador</label>
                    <input type="text" name="organizador" class="form-control"
                           value="${datosAviso.organizador ?? ''}">
                </div>
            `
        };

        return plantillas[tipo] ?? '';
    }

    // Evento cuando el usuario cambia de categoría
    categoriaSelect.addEventListener('change', function() {
        const tipo = this.options[this.selectedIndex].getAttribute('data-tipo');
        camposExtra.innerHTML = getPlantilla(tipo);
    });

    // Al cargar la vista, cargar la plantilla según la categoría guardada
    const tipoInicial =
        categoriaSelect.options[categoriaSelect.selectedIndex].getAttribute('data-tipo');

    camposExtra.innerHTML = getPlantilla(tipoInicial);

});
</script>

@endsection

