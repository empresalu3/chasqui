@extends('layouts.user')

@section('content')
<div class="container" style="max-width: 450px; margin-top: 40px;">

    <h2 class="text-center mb-4"> Recuperar contraseña</h2>

    <p class="text-center mb-3">
        Ingresa tu correo y te enviaremos un enlace para restablecer tu contraseña.
    </p>

    <!-- Mensaje de éxito -->
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-3">
            <label for="email">Correo electrónico</label>
            <input type="email" name="email" class="form-control" required autofocus>
        </div>

        <button type="submit" class="btn btn-primary w-100">
            Enviar enlace de recuperación
        </button>

        <div class="text-center mt-3">
            <a href="{{ route('login') }}">← Volver a iniciar sesión</a>
        </div>

    </form>

</div>
@endsection
