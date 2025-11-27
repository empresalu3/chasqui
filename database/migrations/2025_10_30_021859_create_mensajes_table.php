<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMensajesTable extends Migration
{
    public function up()
    {
        Schema::create('mensajes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('emisor_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('receptor_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('aviso_id')->nullable()->constrained('avisos')->onDelete('set null');
            $table->text('contenido');
            $table->boolean('leido')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mensajes');
    }
}
