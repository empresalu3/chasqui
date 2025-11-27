<?php

namespace App\Http\Controllers\User;

use App\Models\Categoria;
use App\Http\Controllers\Controller;
use App\Models\Aviso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Imagen;


class AvisoController extends Controller
{
    public function index()
    {
        // Mostrar solo los avisos activos
        $avisos = Aviso::with(['imagenes', 'categoria'])
            ->where('estado', 'activo')
            ->where('estado_publicacion', 'aprobado')
            //->where('destacado', true)
            ->orderBy('destacado', 'desc')// primero los destacados
            ->orderBy('created_at', 'desc')//luego los mas recientes
            ->latest()
            ->paginate(9);

            // Mostrar avisos destacados
            $destacados = Aviso::with(['imagenes', 'categoria'])
            ->where('estado', 'activo')
            ->where('estado_publicacion', 'aprobado')
            ->where('destacado', true)
            ->orderBy('destacado', 'desc')// primero los destacados
            ->orderBy('created_at', 'desc')//luego los mas recientes
            ->latest()
            ->paginate(9);

   

        return view('user.avisos.index', compact('destacados','avisos'));
    }

    public function store(Request $request)
{   //validar datos
    $request->validate([
        'titulo' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'categoria_id' => 'required|exists:categorias,id',
        'precio' => 'nullable|numeric',
        'ubicacion' => 'nullable|string|max:255',
        'imagenes.*' => 'nullable|image|max:5120',
        //campos adicionales dinamicos
        'tipo_contrato' => 'nullable|string|max:255',
        'empresa' => 'nullable|string|max:255',
        'requisitos' => 'nullable|string',
        'fecha_inicio' => 'nullable|date',
        'fecha_fin' => 'nullable|date',
        'organizador' => 'nullable|string|max:255',
        'capacidad' => 'nullable|integer',
        'estado_producto' => 'nullable|string|max:255',
    ]);
    //crear aviso en estado pendiente
    //datos filtrados
    $data = $request->only([
        'categoria_id', 'titulo', 'descripcion', 'precio', 'ubicacion',
        'tipo_contrato', 'empresa', 'requisitos', 'fecha_inicio',
        'fecha_fin', 'organizador', 'capacidad', 'estado_producto'
    ]);

    $data['user_id'] = auth()->id();
    $data['estado_publicacion'] = 'pendiente';
    $data['estado'] = 'activo';

    $aviso = Aviso::create(array_filter($data));
    //guardar imagenes
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
    //redireccionar con mensaje
    return redirect()
        ->route('user.avisos.index')
        ->with('success', 'Tu aviso fue enviado y está pendiente de revisión.');
}

//solo para el usuario
     // Mostrar los avisos del usuario logueado
    public function indexUser()
    {
        $avisos = Aviso::with('imagenes', 'categoria')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.avisos.mis-avisos', compact('avisos'));
    }

    // Formulario para crear aviso
    public function create()
    {
        $categorias = Categoria::all();
        return view('user.avisos.create', compact('categorias'));
    }
    //metodo para editar aviso
    public function edit($id)
    {
        $aviso = Aviso::findOrFail($id);
        // el usuario solo puede editar sus avisos
    if ($aviso->user_id !== auth()->id()) {
        abort(403, 'No tienes permiso para editar este aviso');
    }

        $categorias = Categoria::all();
        return view('user.avisos.edit', compact('aviso', 'categorias'));
    }
    // Actualizar aviso
    public function update(Request $request, $id)
    {
        $aviso = Aviso::findOrFail($id);

        // el usuario solo puede actualizar sus avisos
        if ($aviso->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para actualizar este aviso');
        }
        // Validar datos
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'categoria_id' => 'required|exists:categorias,id',
            'precio' => 'nullable|numeric',
            'ubicacion' => 'nullable|string|max:255',
            'imagenes.*' => 'nullable|image|max:5120',
            // campos dinámicos:
        'tipo_contrato' => 'nullable|string|max:255',
        'empresa' => 'nullable|string|max:255',
        'requisitos' => 'nullable|string',
        'fecha_inicio' => 'nullable|date',
        'fecha_fin' => 'nullable|date',
        'organizador' => 'nullable|string|max:255',
        'capacidad' => 'nullable|integer',
        'estado_producto' => 'nullable|string|max:255',
        ]);
        // Actualizar datos 
        $aviso->update([
        'categoria_id' => $request->categoria_id,
        'titulo' => $request->titulo,
        'descripcion' => $request->descripcion,
        'precio' => $request->precio,
        'ubicacion' => $request->ubicacion,

        // datos dinámicos
        'tipo_contrato' => $request->tipo_contrato,
        'empresa' => $request->empresa,
        'requisitos' => $request->requisitos,
        'fecha_inicio' => $request->fecha_inicio,
        'fecha_fin' => $request->fecha_fin,
        'organizador' => $request->organizador,
        'capacidad' => $request->capacidad,
        'estado_producto' => $request->estado_producto,
    ]);

        // Guardar nuevas imágenes si existen
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

        return redirect()
            ->route('user.avisos.mis-avisos')
            ->with('success', 'Aviso actualizado correctamente.');
    }

    // Eliminar aviso
    public function destroy($id)
    {
        $aviso = Aviso::findOrFail($id);

        // el usuario solo puede eliminar sus avisos
        if ($aviso->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para eliminar este aviso');
        }

        // Eliminar imágenes asociadas
        foreach ($aviso->imagenes as $imagen) {
            // Eliminar archivo físico
            $filePath = str_replace('/storage/', 'public/', $imagen->ruta);
            Storage::delete($filePath);
            // Eliminar registro de la base de datos
            $imagen->delete();
        }

        // Eliminar el aviso
        $aviso->delete();

        return redirect()
            ->route('user.avisos.mis-avisos')
            ->with('success', 'Aviso eliminado correctamente.');
    }

    // Guardar aviso en estado pendiente
    public function storeUser(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'categoria_id' => 'required|exists:categorias,id',
            'precio' => 'nullable|numeric',
            'ubicacion' => 'nullable|string|max:255',
            'fecha_expiracion' => 'nullable|date',
            'imagenes.*' => 'nullable|image|max:5120', // máx 5MB
        ]);

        // Crear aviso pendiente
        $aviso = Aviso::create([
            'user_id' => auth()->id(),
            'categoria_id' => $request->categoria_id,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'ubicacion' => $request->ubicacion,
            'fecha_expiracion' => $request->fecha_expiracion ?? now()->addDays(30),
            'estado' => 'pendiente',
            'destacado' => false,
        ]);

        // Guardar imágenes
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $file) {
                $path = $file->store('public/avisos');
                $url = Storage::url($path);

                Imagen::create([
                    'aviso_id' => $aviso->id,
                    'ruta' => $url,
                ]);
            }
        }

        return redirect()
            ->route('user.avisos.index')
            ->with('success', ' Tu aviso fue enviado y está pendiente de aprobación.');
    }

    public function show($id)
    {
        $aviso = Aviso::with(['imagenes', 'categoria', 'user'])->findOrFail($id);

        // Verificar que el aviso esté activo y aprobado
        if ($aviso->estado !== 'activo' || $aviso->estado_publicacion !== 'aprobado') {
            abort(404);
        }

        return view('user.avisos.show', compact('aviso'));
    }
    //mostrar avisos por categoria
    public function porCategoria($id)
{
    $avisos = Aviso::with(['imagenes', 'categoria'])
        ->where('estado_publicacion', 'aprobado') // solo aprobados
        ->where('categoria_id', $id)
        ->latest()
        ->paginate(9);

    $categoriaNombre = \App\Models\Categoria::find($id)?->nombre ?? 'Sin categoría';

    return view('user.avisos.categoria', compact('avisos', 'categoriaNombre'));
}




}
