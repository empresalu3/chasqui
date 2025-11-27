<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAvisoRequest;
use App\Http\Requests\UpdateAvisoRequest;
use App\Models\Aviso;
use App\Models\Categoria;
use App\Models\Imagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AvisoController extends Controller
{
    public function index(Request $request)
    {
        $query = Aviso::with('categoria','user');

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where('titulo', 'like', "%{$q}%")
                  ->orWhere('descripcion', 'like', "%{$q}%");
        }

        if ($request->filled('categoria')) {
            $query->where('categoria_id', $request->categoria);
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        $avisos = $query->orderBy('created_at','desc')->paginate(12)->withQueryString();
        $categorias = Categoria::all();

        return view('admin.avisos.index', compact('avisos','categorias'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('admin.avisos.create', compact('categorias'));
    }

    public function store(Request $request)
{
    // 1️ Validar los datos manualmente
    $request->validate([
        'titulo' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'categoria_id' => 'required|exists:categorias,id',
        'precio' => 'nullable|numeric',
        'ubicacion' => 'nullable|string|max:255',
        'fecha_expiracion' => 'nullable|date',
        'imagenes.*' => 'nullable|image|max:5120', // 5MB por imagen
        'destacado' => 'nullable|boolean',
        // Campos adicionales opcionales
        'tipo_contrato' => 'nullable|string|max:255',
        'empresa' => 'nullable|string|max:255',
        'requisitos' => 'nullable|string',
        'fecha_inicio' => 'nullable|date',
        'fecha_fin' => 'nullable|date',
        'organizador' => 'nullable|string|max:255',
        'capacidad' => 'nullable|integer',
        'estado_producto' => 'nullable|string|max:255',
    ]);

    // 2️ Crear el aviso con el usuario autenticado
    // Datos filtrados
    //datos filtrados
    $data = $request->only([
        'categoria_id', 'titulo', 'descripcion', 'precio', 'ubicacion',
        'tipo_contrato', 'empresa', 'requisitos', 'fecha_inicio',
        'fecha_fin', 'organizador', 'capacidad', 'estado_producto'
    ]);

    $data['user_id'] = auth()->id();
    $data['estado_publicacion'] = 'aprobado';
    $data['estado'] = 'activo';

    $aviso = Aviso::create(array_filter($data));

    // 3️Guardar las imágenes si existen
    if ($request->hasFile('imagenes')) {
        foreach ($request->file('imagenes') as $file) {

            $path = $file->store('avisos','public');
            $url = Storage::url($path);

            Imagen::create([
                'aviso_id' => $aviso->id,
                'ruta' => $url,
            ]);
        }
    }

    // 4️Redirigir con mensaje
    return redirect()
        ->route('admin.avisos.index')
        ->with('success', 'Aviso creado correctamente.');
}


    public function show(Aviso $aviso)
    {
        $aviso->load('imagenes','categoria','user');
        return view('admin.avisos.show', compact('aviso'));
    }

    public function edit(Aviso $aviso)
    {
        $categorias = Categoria::all();
        return view('admin.avisos.edit', compact('aviso','categorias'));
    }

    public function update(UpdateAvisoRequest $request, Aviso $aviso)
    {
        $data = $request->validated();
        $data['destacado'] = $request->has('destacado');
        $aviso->update($data);

        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $file) {
                $path = $file->store('avisos','public');
                $url = Storage::url($path);
                Imagen::create([
                    'aviso_id' => $aviso->id,
                    'ruta' => $url,
                ]);
            }
        }

        return redirect()->route('admin.avisos.index')->with('success','Aviso actualizado.');
    }

    public function destroy(Aviso $aviso)
    {
        // eliminar imágenes físicas y registros si aplica
        foreach ($aviso->imagenes as $img) {
            $file = str_replace('/storage/', 'public/', $img->ruta);
            Storage::delete($file);
            $img->delete();
        }

        $aviso->delete();
        return redirect()->route('admin.avisos.index')->with('success','Aviso eliminado.');
    }

    // Acciones rápidas: publicar / despublicar
    public function toggleEstado(Aviso $aviso)
    {
        $aviso->estado = $aviso->estado === 'activo' ? 'pausado' : 'activo';
        $aviso->save();
        return redirect()->back()->with('success','Estado actualizado.');
    }
    //destacar o quitar destacado
    public function toggleDestacado(Aviso $aviso)
    {
        $aviso->destacado = !$aviso->destacado;
        $aviso->save();
        return redirect()->back()->with('success','Campo destacado actualizado.');
    }
//metodo para aprobar o rechazar avisos de los usuarios
    //  Aprobar un aviso
public function aprobar(Aviso $aviso)
{
    $aviso->update([
        'estado_publicacion' => 'aprobado',
        'estado' => 'activo',
        'fecha_aprobacion' => now(),
        'fecha_expiracion' => now()->addDays(30), // 30 días de duración
        'motivo_rechazo' => null,
    ]);

    return redirect()->back()->with('success', 'Aviso aprobado y publicado.');
}

//  Rechazar un aviso
public function rechazar(Request $request, Aviso $aviso)
{
    $request->validate([
        'motivo_rechazo' => 'required|string|max:500',
    ]);

    $aviso->update([
        'estado_publicacion' => 'rechazado',
        'estado' => 'pausado',
        'motivo_rechazo' => $request->motivo_rechazo,
    ]);

    return redirect()->back()->with('error', 'Aviso rechazado.');
}

}
