<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('avisos', function (Blueprint $table) {
        $table->string('tipo_contrato')->nullable();
        $table->string('empresa')->nullable();
        $table->text('requisitos')->nullable();
        $table->date('fecha_inicio')->nullable();
        $table->date('fecha_fin')->nullable();
        $table->string('organizador')->nullable();
        $table->integer('capacidad')->nullable();
        $table->string('estado_producto')->nullable();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('avisos', function (Blueprint $table) {
            //
        });
    }
};
