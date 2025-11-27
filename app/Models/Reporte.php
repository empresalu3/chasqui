<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reporte extends Model
{
    use HasFactory;

    protected $fillable = ['aviso_id','user_id','motivo','detalle','estado'];

    public function aviso()
    {
        return $this->belongsTo(Aviso::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
