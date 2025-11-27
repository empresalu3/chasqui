@extends('layouts.auth')

@section('title', 'Registrarse')

@section('content')
<div class="register-container">
    <h1>Crear cuenta</h1>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label for="name">Nombre completo</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
            @error('name') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label for="email">Correo electrónico</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required>
            @error('email') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input id="telefono" type="text" name="telefono" value="{{ old('telefono') }}" required>
            @error('telefono') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input id="direccion" type="text" name="direccion" value="{{ old('direccion') }}" required>
            @error('direccion') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label for="password">Contraseña</label>
            <input id="password" type="password" name="password" required>
            @error('password') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirmar contraseña</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required>
        </div>

        <button type="submit" class="btn-login">Registrarse</button>

        <p class="register-link">
            ¿Ya tienes una cuenta?
            <a href="{{ route('login') }}">Iniciar sesión</a>
        </p>
    </form>
</div>
@endsection
