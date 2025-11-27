@extends('layouts.user')

@section('content')
<div class="container py-5">
    <h1>Blog</h1>

    <div class="row">
        @foreach($posts as $post)
            <div class="col-md-4 mb-4">
                <div class="card card-body">
                    <h4>{{ $post['titulo'] }}</h4>
                    <p>{{ $post['resumen'] }}</p>
                    <a href="{{ route('public.blog.detalle', $post['slug']) }}" class="btn btn-primary">
                        Leer más
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
