@extends('layouts.admin')

@section('title','Gestionar Avisos')

@section('content')
<div>
    <h2>Gestión de Avisos</h2>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <div style="display:flex;gap:10px;margin:15px 0;">
        <form action="{{ route('admin.avisos.index') }}" method="GET" style="display:flex;gap:8px;">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Buscar por título o descripción">
            <select name="categoria">
                <option value="">Todas las categorías</option>
                @foreach($categorias as $cat)
                    <option value="{{ $cat->id }}" @selected(request('categoria') == $cat->id)>{{ $cat->nombre ?? $cat->label ?? $cat->name }}</option>
                @endforeach
            </select>
            <select name="estado">
                <option value="">Todos los estados</option>
                <option value="pendiente" @selected(request('estado')=='pendiente')>Pendiente</option>
                <option value="activo" @selected(request('estado')=='activo')>Activo</option>
                <option value="finalizado" @selected(request('estado')=='finalizado')>Finalizado</option>
            </select>
            <button type="submit">Filtrar</button>
        </form>

        <a href="{{ route('admin.avisos.create') }}" class="action-btn primary">➕ Nuevo Aviso</a>
    </div>

    <table style="width:100%;border-collapse:collapse;">
        <thead>
            <tr>
                <th>Título</th>
                <th>Categoría</th>
                <th>Usuario</th>
                <th>Estado</th>
                <th>Destacado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($avisos as $aviso)
            <tr>
                <td>{{ $aviso->titulo }}</td>
                <td>{{ $aviso->categoria->nombre ?? '-' }}</td>
                <td>{{ $aviso->user->name ?? 'Anon' }}</td>
                <td>{{ ucfirst($aviso->estado) }}</td>
                <td>{{ $aviso->destacado ? 'Sí' : 'No' }}</td>
                <td style="display:flex;gap:6px;flex-wrap:wrap;">
                    <a href="{{ route('admin.avisos.edit', $aviso) }}" class="btn">Editar</a>

                    <form action="{{ route('admin.avisos.toggleEstado', $aviso) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn">{{ $aviso->estado=='activo' ? 'Despublicar' : 'Publicar' }}</button>
                    </form>

                    <form action="{{ route('admin.avisos.toggleDestacado', $aviso) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn">{{ $aviso->destacado ? 'Quitar destaque' : 'Destacar' }}</button>
                    </form>

                    {{-- NUEVA LÓGICA DE ESTADO DE PUBLICACIÓN --}}
                    @if($aviso->estado_publicacion == 'pendiente')
                        <form action="{{ route('admin.avisos.aprobar', $aviso->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-success btn-sm" onclick="return confirm('¿Aprobar este aviso?')">
                                Aprobar
                            </button>
                        </form>

                        <form action="{{ route('admin.avisos.rechazar', $aviso->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Rechazar este aviso?')">
                                Rechazar
                            </button>
                        </form>
                    @elseif($aviso->estado_publicacion == 'aprobado')
                        <span class="badge bg-success">Aprobado</span>
                    @elseif($aviso->estado_publicacion == 'rechazado')
                        <span class="badge bg-danger">Rechazado</span>
                    @endif

                    <form action="{{ route('admin.avisos.destroy', $aviso) }}" method="POST" onsubmit="return confirm('Eliminar aviso?');" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn delete">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6">No hay avisos</td></tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 12px;">{{ $avisos->links() }}</div>
</div>
@endsection
