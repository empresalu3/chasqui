@extends('layouts.user')

@section('content')
<div class="container py-5">
    <h1>{{ $post['titulo'] }}</h1>

    <p class="mt-4">
        {!! nl2br(e($post['contenido'])) !!}
    </p>
</div>
@endsection
