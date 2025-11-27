<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aviso;

class DashboardController extends Controller
{
    public function index()
    {
        // Traer todos los avisos, o los más recientes
        $avisos = Aviso::latest()->get();

        //cantidad de publicaciones activas
        $publicaciones_activas = Aviso::where('estado_publicacion', 'aprobado')
        ->where('estado', 'activo')
        ->count();

         // También podrías agregar otros datos si los usas en las tarjetas
        $avisosPendientes = Aviso::where('estado_publicacion', 'pendiente')->count();
        $avisosExpirados = Aviso::where('estado_publicacion', 'expirado')->count();


        // Pasar a la vista
        return view('admin.dashboard', compact('avisos', 'publicaciones_activas', 'avisosPendientes', 'avisosExpirados'));
    }
}
