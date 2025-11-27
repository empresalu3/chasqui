@extends('layouts.user')

@section('content')
<div class="container py-5">
    <h1>Contacto</h1>
    <p>¿Tienes consultas o sugerencias? Escríbenos.</p>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('public.contacto.enviar') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Correo</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Mensaje</label>
            <textarea name="mensaje" rows="4" class="form-control" required></textarea>
        </div>

        <button class="btn btn-primary">Enviar Mensaje</button>
    </form>
</div>
@endsection
