@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Editar Usuario</h2>

    <form action="{{ route('admin.usuarios.update', $usuario) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="name" class="form-control" value="{{ $usuario->name }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $usuario->email }}" required>
        </div>

        <div class="mb-3">
            <label>Rol</label>
            <select name="role_id" class="form-control">
                <option value="1" {{ $usuario->role_id == 1 ? 'selected' : '' }}>Administrador</option>
                <option value="2" {{ $usuario->role_id == 2 ? 'selected' : '' }}>Usuario</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('admin.usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
