<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Aviso extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','categoria_id','titulo','descripcion','precio',
        'ubicacion','destacado','estado', 'estado_publicacion','fecha_aprobacion',
        'fecha_expiracion','motivo_rechazo',
        // Campos opcionales por categoría
        'tipo_contrato',
        'empresa',
        'requisitos',
        'fecha_inicio',
        'fecha_fin',
        'organizador',
        'capacidad',
        'estado_producto',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function imagenes()
    {
        return $this->hasMany(Imagen::class);
    }

    public function favoritos()
    {
        return $this->hasMany(Favorito::class);
    }

    public function mensajes()
    {
        return $this->hasMany(Mensaje::class, 'aviso_id');
    }

    public function reportes()
    {
        return $this->hasMany(Reporte::class, 'aviso_id');
    }
}
