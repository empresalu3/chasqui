@extends('layouts.user')

@section('content')
<div class="container">
    <h2>Publicar un aviso</h2>

    <form action="{{ route('user.avisos.store') }}" method="POST" enctype="multipart/form-data" id="formAviso">
        @csrf

        <!-- Categoría -->
        <div class="mb-3">
            <label for="categoria_id">Categoría</label>
            <select name="categoria_id" id="categoria_id" class="form-control" required>
                <option value="">Seleccione una categoría</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" data-tipo="{{ strtolower($categoria->nombre) }}">{{ $categoria->nombre }}</option>
                @endforeach
            </select>
        </div>

        <!-- Campos comunes -->
        <div class="mb-3">
            <label for="titulo">Título</label>
            <input type="text" name="titulo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="ubicacion">Ubicación</label>
            <input type="text" name="ubicacion" class="form-control" required>
        </div>

        <!-- Sección dinámica: campos extra -->
        <div id="camposExtra"></div>

<!-- Input para agregar 1 imagen -->
<div class="mb-3">
    <label>Imágenes</label>
    <input type="file" id="imagenInput" class="form-control">

    <p class="text-muted mt-2">Puedes agregar varias imágenes una por una.</p>

    <!-- Previsualización -->
    <div id="previewContainer" class="mt-3" style="display:flex; flex-wrap:wrap; gap:10px;"></div>

    <!-- Input oculto con TODAS las imágenes finales -->
    <input type="file" name="imagenes[]" id="imagenesFinal" multiple hidden>
</div>


        <button type="submit" class="btn btn-primary">Publicar Aviso</button>
    </form>
</div>

<!-- Script dinámico -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const categoriaSelect = document.getElementById('categoria_id');
    const camposExtra = document.getElementById('camposExtra');

    categoriaSelect.addEventListener('change', function() {
        const tipo = this.options[this.selectedIndex].getAttribute('data-tipo');
        camposExtra.innerHTML = ''; // Limpiar

        // Plantillas por tipo
        const plantillas = {
            'empleos': `
                <div class="mb-3"><label>Tipo de Contrato</label><input type="text" name="tipo_contrato" class="form-control"></div>
                <div class="mb-3"><label>Salario</label><input type="number" name="salario" class="form-control"></div>
                <div class="mb-3"><label>Empresa/Empleador</label><input type="text" name="empresa" class="form-control"></div>
                <div class="mb-3"><label>Requisitos</label><textarea name="requisitos" class="form-control"></textarea></div>
            `,
            'compra/venta': `
                <div class="mb-3"><label>Precio</label><input type="number" name="precio" class="form-control"></div>
                <div class="mb-3"><label>Estado del Producto</label><input type="text" name="estado_producto" class="form-control"></div>
            `,
            'alquileres': `
                <div class="mb-3"><label>Precio</label><input type="number" name="precio" class="form-control"></div>
            `,
            'eventos': `
                <div class="mb-3"><label>Precio</label><input type="number" name="precio" class="form-control"></div>
                <div class="mb-3"><label>Fecha Inicio</label><input type="datetime-local" name="fecha_inicio" class="form-control"></div>
                <div class="mb-3"><label>Fecha Fin</label><input type="datetime-local" name="fecha_fin" class="form-control"></div>
                <div class="mb-3"><label>Organizador</label><input type="text" name="organizador" class="form-control"></div>
                <div class="mb-3"><label>Capacidad</label><input type="number" name="capacidad" class="form-control"></div>
            `,
            'servicios': `
                <div class="mb-3"><label>Fecha Inicio</label><input type="date" name="fecha_inicio" class="form-control"></div>
                <div class="mb-3"><label>Fecha Fin</label><input type="date" name="fecha_fin" class="form-control"></div>
                <div class="mb-3"><label>Organizador</label><input type="text" name="organizador" class="form-control"></div>
            `
        };

        // Mostrar los campos según categoría
        if (plantillas[tipo]) {
            camposExtra.innerHTML = plantillas[tipo];
        }
    });
});

</script>
<script>
let imagenesAcumuladas = [];

// Evento cuando se selecciona una imagen
document.getElementById('imagenInput').addEventListener('change', function (event) {
    let archivo = event.target.files[0];

    if (archivo) {
        imagenesAcumuladas.push(archivo);
        mostrarPreview(archivo, imagenesAcumuladas.length - 1);
        actualizarInputFinal();
    }

    event.target.value = ""; // Permitir seleccionar la misma imagen otra vez
});

// Mostrar previsualización con botón de eliminar
function mostrarPreview(archivo, index) {
    const reader = new FileReader();
    
    reader.onload = function (e) {
        const previewDiv = document.createElement('div');
        previewDiv.style.position = "relative";

        const img = document.createElement('img');
        img.src = e.target.result;
        img.style.width = "120px";
        img.style.height = "120px";
        img.style.objectFit = "cover";
        img.style.borderRadius = "6px";
        img.style.border = "1px solid #ddd";

        // Botón eliminar
        const btn = document.createElement('button');
        btn.innerHTML = "✖";
        btn.style.position = "absolute";
        btn.style.top = "5px";
        btn.style.right = "5px";
        btn.style.background = "rgba(0,0,0,0.7)";
        btn.style.color = "white";
        btn.style.border = "none";
        btn.style.borderRadius = "50%";
        btn.style.cursor = "pointer";
        btn.style.width = "24px";
        btn.style.height = "24px";
        btn.style.fontSize = "14px";

        btn.onclick = function () {
            eliminarImagen(index);
        };

        previewDiv.appendChild(img);
        previewDiv.appendChild(btn);
        previewDiv.dataset.index = index;
        document.getElementById('previewContainer').appendChild(previewDiv);
    };

    reader.readAsDataURL(archivo);
}

// Eliminar imagen
function eliminarImagen(index) {
    // Borrarla del array
    imagenesAcumuladas.splice(index, 1);

    // Reconstruir previews
    reconstruirPreviews();

    // Reconstruir input hidden
    actualizarInputFinal();
}

function reconstruirPreviews() {
    const container = document.getElementById('previewContainer');
    container.innerHTML = "";

    imagenesAcumuladas.forEach((archivo, i) => {
        mostrarPreview(archivo, i);
    });
}

// Actualiza input hidden donde se guardan TODAS las imágenes finales
function actualizarInputFinal() {
    const dataTransfer = new DataTransfer();

    imagenesAcumuladas.forEach(img => {
        dataTransfer.items.add(img);
    });

    document.getElementById('imagenesFinal').files = dataTransfer.files;
}
</script>


@endsection
