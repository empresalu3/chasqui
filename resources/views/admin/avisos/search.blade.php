<html><!DOCTYPE html>
<head>
    <title>Buscar Avisos - Administrador</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <div class="container">
        <h2>Buscar Avisos</h2>

        <form action="{{ route('admin.avisos.search') }}" method="GET" style="margin-bottom:20px;">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Buscar por título o descripción">
            <button type="submit">Buscar</button>
        </form>

        @if($avisos->isEmpty())
            <p>No se encontraron avisos que coincidan con la búsqueda.</p>
        @else
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
                    @foreach($avisos as $aviso)
                    <tr>
                        <td>{{ $aviso->titulo }}</td>
                        <td>{{ $aviso->categoria->nombre ?? '-' }}</td>
                        <td>{{ $aviso->user->name ?? 'Anon' }}</td>
                        <td>{{ ucfirst($aviso->estado) }}</td>
                        <td>{{ $aviso->destacado ? 'Sí' : 'No' }}</td>
                        <td style="display:flex;gap:6px;">
                            <a href="{{ route('admin.avisos.edit', $aviso) }}" class="btn">Editar</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>