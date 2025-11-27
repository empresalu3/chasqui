@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Usuarios</h2>
    <a href="{{ route('admin.usuarios.create') }}" class="btn btn-primary mb-3">Nuevo Usuario</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->id }}</td>
                <td>{{ $usuario->name }}</td>
                <td>{{ $usuario->email }}</td>
                <td>{{ $usuario->role_id == 1 ? 'Administrador' : 'Usuario' }}</td>
                <td>
                    <a href="{{ route('admin.usuarios.edit', $usuario) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('admin.usuarios.destroy', $usuario) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este usuario?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $usuarios->links() }}
</div>
@endsection
