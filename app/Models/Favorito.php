<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Favorito extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','aviso_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function aviso()
    {
        return $this->belongsTo(Aviso::class);
    }
}
