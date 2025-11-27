<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAvisoRequest extends FormRequest
{
    public function authorize(): bool { return auth()->check(); }

    public function rules(): array
    {
        return [
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'categoria_id' => 'nullable|exists:categorias,id',
            'precio' => 'nullable|numeric',
            'ubicacion' => 'nullable|string|max:255',
            'fecha_expiracion' => 'nullable|date',
            'imagenes.*' => 'nullable|image|max:5120', // 5MB por imagen
            'destacado' => 'sometimes|boolean',
        ];
    }
}
