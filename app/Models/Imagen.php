<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Imagen extends Model
{
    use HasFactory;

    protected $table = 'imagenes';

    protected $fillable = ['aviso_id','ruta','es_principal'];

    public function aviso()
    {
        return $this->belongsTo(Aviso::class);
    }
}
