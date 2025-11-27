@extends('layouts.app')

@section('content')
<nav class="bg-white shadow p-4 flex justify-between">
    <a href="{{ route('public.home') }}" class="font-bold text-blue-700">Chasqui Express</a>
    <div>
        <a href="{{ route('login') }}" class="mr-4">Iniciar sesión</a>
        <a href="{{ route('register') }}" class="text-blue-700">Registrarse</a>
    </div>
</nav>

<div class="container mx-auto p-6">
    @yield('body')
</div>
@endsection
