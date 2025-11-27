<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('avisos', function (Blueprint $table) {
        $table->enum('estado_publicacion', ['pendiente', 'aprobado', 'rechazado', 'expirado'])
              ->default('pendiente')
              ->after('estado');
        $table->text('motivo_rechazo')->nullable()->after('estado_publicacion');
        $table->timestamp('fecha_aprobacion')->nullable()->after('motivo_rechazo');
        $table->date('fecha_expiracion')->nullable()->after('fecha_aprobacion');
    });
}

public function down(): void
{
    Schema::table('avisos', function (Blueprint $table) {
        $table->dropColumn(['estado_publicacion', 'motivo_rechazo', 'fecha_aprobacion', 'fecha_expiracion']);
    });
}

};
