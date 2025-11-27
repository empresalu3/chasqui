<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aviso;
use App\Models\Categoria;

class PublicController extends Controller
{
    public function home()
    {

        $categorias = Categoria::all();
        // Avisos destacados (primero)
        $destacados = Aviso::with('imagenes', 'categoria')
            ->where('estado_publicacion', 'aprobado')
            ->where('estado', 'activo')
            ->where('destacado', true)
            ->latest()
            ->take(8)
            ->get();

        // Avisos recientes
        $recientes = Aviso::with('imagenes', 'categoria', 'user')
            ->where('estado_publicacion', 'aprobado')
            ->where('estado', 'activo')
            ->latest()
            ->paginate(12);

        

        return view('public.home', compact('destacados', 'recientes', 'categorias'));
    }

    public function porCategoria($id)
{
    $categorias = Categoria::all();
    
    $avisos = Aviso::with(['imagenes', 'categoria', 'user'])
        ->where('estado_publicacion', 'aprobado') // solo aprobados
        ->where('estado', 'activo')
        ->where('categoria_id', $id)
        ->latest()
        ->paginate(9);

    $categoriaNombre = Categoria::find($id)?->nombre ?? 'Sin categoría';

    return view('public.categoria', compact('avisos', 'categoriaNombre', 'categorias'));
}

    //metodo de busqueda
    public function buscar(Request $request)
{
    $query = $request->input('q');

    $avisos = Aviso::with(['imagenes', 'categoria'])
        ->where('estado_publicacion', 'aprobado')
        ->where('estado', 'activo')
        ->where(function($qBuilder) use ($query) {
            $qBuilder->where('titulo', 'like', "%{$query}%")
                     ->orWhere('descripcion', 'like', "%{$query}%")
                     ->orWhere('ubicacion', 'like', "%{$query}%");
        })
        ->latest()
        ->paginate(12);

    return view('public.buscar', compact('avisos', 'query'));
}


}
