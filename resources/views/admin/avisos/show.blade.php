@if($aviso->estado_publicacion == 'pendiente')
    <form action="{{ route('admin.avisos.aprobar', $aviso) }}" method="POST" style="display:inline;">
        @csrf
        @method('PATCH')
        <button type="submit" class="btn btn-success">Aprobar</button>
    </form>

    <form action="{{ route('admin.avisos.rechazar', $aviso) }}" method="POST" style="display:inline;">
        @csrf
        @method('PATCH')
        <input type="text" name="motivo_rechazo" placeholder="Motivo del rechazo" required>
        <button type="submit" class="btn btn-danger">Rechazar</button>
    </form>
@endif
