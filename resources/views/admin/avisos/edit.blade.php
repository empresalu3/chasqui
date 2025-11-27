@extends('layouts.admin')

@section('title','Editar Aviso')

@section('content')
<div>
    <h2>Editar Aviso</h2>

    <form action="{{ route('admin.avisos.update', $aviso) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div>
            <label>Título</label>
            <input type="text" name="titulo" value="{{ old('titulo', $aviso->titulo) }}" required>
            @error('titulo')<p class="error">{{ $message }}</p>@enderror
        </div>

        <div>
            <label>Categoría</label>
            <select name="categoria_id">
                <option value="">-- Seleccionar --</option>
                @foreach($categorias as $cat)
                    <option value="{{ $cat->id }}" @selected(old('categoria_id', $aviso->categoria_id)==$cat->id)>{{ $cat->nombre ?? $cat->label ?? $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Descripción</label>
            <textarea name="descripcion" rows="6" required>{{ old('descripcion', $aviso->descripcion) }}</textarea>
        </div>

        <div>
            <label>Imágenes actuales</label>
            <div style="display:flex;gap:8px;flex-wrap:wrap;">
                @foreach($aviso->imagenes as $img)
                    <div style="width:100px">
                        <img src="{{ $img->ruta }}" style="width:100%;border-radius:6px;">
                    </div>
                @endforeach
            </div>
            <label>Agregar más imágenes</label>
            <input type="file" name="imagenes[]" multiple accept="image/*">
        </div>

        <div>
            <label><input type="checkbox" name="destacado" {{ old('destacado', $aviso->destacado) ? 'checked':'' }}> Destacado</label>
        </div>

        <button type="submit" class="action-btn primary">Actualizar</button>
    </form>
</div>
@endsection
