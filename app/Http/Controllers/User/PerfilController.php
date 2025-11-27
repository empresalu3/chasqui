<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // obtener usuario autenticado
       // return view('user.perfil.index', compact('user'));
       // $user = auth()->user();
        //estadisticas de avisos del usuario
        $stats = [
            'publicados' => $user->avisos()->where('estado_publicacion', 'aprobado')->count(),
            'pendientes' => $user->avisos()->where('estado_publicacion', 'pendiente')->count(),
            'rechazados' => $user->avisos()->where('estado_publicacion', 'rechazado')->count(),
            'totales'    => $user->avisos()->count(),
        ];

        return view('user.perfil.index', compact('user', 'stats'));
    }

     public function update(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        $user = auth()->user();
        $user->update($request->only(['name','email']));

        return back()->with('success', 'Datos actualizados correctamente.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $user = auth()->user();
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Contraseña actualizada.');
    }
}
