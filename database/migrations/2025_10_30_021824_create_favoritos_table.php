<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritosTable extends Migration
{
    public function up()
    {
        Schema::create('favoritos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('aviso_id')->constrained('avisos')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['user_id','aviso_id']); // evita duplicados
        });
    }

    public function down()
    {
        Schema::dropIfExists('favoritos');
    }
}
