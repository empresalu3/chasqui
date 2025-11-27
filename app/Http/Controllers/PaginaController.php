<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PaginaController extends Controller
{
    public function sobre()
    {
        return view('public.sobre');
    }

    public function contacto()
    {
        return view('public.contacto');
    }

    public function enviarContacto(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email',
            'mensaje' => 'required|min:10',
        ]);

        // Aquí podrías enviar correo o guardar en BD
        // Mail::to('tu_email@gmail.com')->send(new ContactoMailable($request));

        return back()->with('success', 'Tu mensaje fue enviado correctamente. Gracias por contactarnos.');
    }

    public function blog()
    {
        // Luego puedes reemplazar con BD
        $posts = [
            [
                'titulo' => 'Cómo funciona Chasqui Express',
                'slug'   => 'como-funciona-chasqui',
                'resumen'=> 'Descubre cómo nuestra plataforma conecta a miles de usuarios...',
            ],
            [
                'titulo' => 'Consejos para publicar anuncios exitosos',
                'slug'   => 'consejos-publicar-anuncios',
                'resumen'=> 'Aprende a destacar tus publicaciones y obtener más visitas...',
            ],
        ];
        
        return view('public.blog', compact('posts'));
    }

    public function blogDetalle($slug)
    {
        // Más adelante puedes traer esto desde BD
        $postsEjemplo = [
            'como-funciona-chasqui' => [
                'titulo' => 'Cómo funciona Chasqui Express',
                'contenido' => 'Chasqui Express es una plataforma que conecta...',
            ],
            'consejos-publicar-anuncios' => [
                'titulo' => 'Consejos para publicar anuncios exitosos',
                'contenido' => 'Si deseas que tu anuncio tenga más visitas...',
            ]
        ];

        if (!isset($postsEjemplo[$slug])) {
            abort(404);
        }

        $post = $postsEjemplo[$slug];

        return view('public.blog-detalle', compact('post'));
    }

    public function prensa()
    {
        return view('public.prensa');
    }
}
