@extends('layouts.user')

@section('content')
<div class="container">

    <h2 class="mb-4">Mi Perfil</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- TARJETAS DE ESTADÍSTICAS -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card card-body text-center bg-primary text-white">
                <h3>{{ $stats['totales'] }}</h3>
                <p>Total de Avisos</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-body text-center bg-success text-white">
                <h3>{{ $stats['publicados'] }}</h3>
                <p>Publicados</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-body text-center bg-warning text-white">
                <h3>{{ $stats['pendientes'] }}</h3>
                <p>Pendientes</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-body text-center bg-danger text-white">
                <h3>{{ $stats['rechazados'] }}</h3>
                <p>Rechazados</p>
            </div>
        </div>
    </div>

    <div class="row">

        <!-- DATOS PERSONALES -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><strong>Información Personal</strong></div>
                <div class="card-body">

                    <form method="POST" action="{{ route('user.perfil.update') }}">
                        @csrf

                        <div class="mb-3">
                            <label>Nombre</label>
                            <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Correo electrónico</label>
                            <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
                        </div>

                        <button class="btn btn-primary">Actualizar datos</button>
                    </form>

                </div>
            </div>
        </div>

        <!-- CAMBIO DE CONTRASEÑA -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><strong>Cambiar Contraseña</strong></div>
                <div class="card-body">

                    <form method="POST" action="{{ route('user.perfil.password') }}">
                        @csrf

                        <div class="mb-3">
                            <label>Nueva contraseña</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Confirmar contraseña</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>

                        <button class="btn btn-secondary">Actualizar contraseña</button>
                    </form>

                </div>
            </div>
        </div>

    </div>

</div>
@endsection
