<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvisosTable extends Migration
{
    public function up()
    
    {
        Schema::create('avisos', function (Blueprint $table) {
            $table->id();
		$table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null'); // autor del aviso
		$table->unsignedBigInteger('categoria_id')->nullable();
		$table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('set null');
            $table->string('titulo', 150);
            $table->text('descripcion');
            $table->decimal('precio', 10, 2)->nullable();
            $table->string('ubicacion')->nullable();

            $table->enum('tipo', ['empleo','venta','alquiler','servicio','otro'])->default('otro');
            $table->boolean('destacado')->default(false);
            $table->enum('estado', ['activo','pausado','eliminado'])->default('activo');
            $table->date('fecha_expiracion')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('avisos');
    }
}

