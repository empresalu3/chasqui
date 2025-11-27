@extends('layouts.auth')

@section('title', 'Iniciar sesión')
@section('content')
<div class="login-container">
    <h1>Iniciar sesión</h1>

    <!-- Mensaje de sesión -->
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="email">Correo electrónico</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label for="password">Contraseña</label>
            <input id="password" type="password" name="password" required>
            @error('password') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div class="form-group remember">
            <label>
                <input type="checkbox" name="remember"> Recuérdame
            </label>
        </div>

        <button type="submit" class="btn-login">Iniciar sesión</button>

        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="forgot-password">¿Olvidaste tu contraseña?</a>
            
        @endif
        <a href="{{ route('register') }}" class="register-link">¿No tienes una cuenta? Regístrate</a>
    </form>
</div>
@endsection
