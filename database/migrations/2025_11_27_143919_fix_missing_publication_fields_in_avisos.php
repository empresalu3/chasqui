<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('avisos', function (Blueprint $table) {
            if (!Schema::hasColumn('avisos', 'estado_publicacion')) {
                $table->enum('estado_publicacion', ['pendiente', 'aprobado', 'rechazado', 'expirado'])
                      ->default('pendiente')
                      ->after('estado');
            }

            if (!Schema::hasColumn('avisos', 'motivo_rechazo')) {
                $table->text('motivo_rechazo')->nullable()->after('estado_publicacion');
            }

            if (!Schema::hasColumn('avisos', 'fecha_aprobacion')) {
                $table->timestamp('fecha_aprobacion')->nullable()->after('motivo_rechazo');
            }

            if (!Schema::hasColumn('avisos', 'fecha_expiracion')) {
                $table->date('fecha_expiracion')->nullable()->after('fecha_aprobacion');
            }
        });
    }

    public function down()
    {
        Schema::table('avisos', function (Blueprint $table) {
            if (Schema::hasColumn('avisos', 'estado_publicacion')) {
                $table->dropColumn('estado_publicacion');
            }
            if (Schema::hasColumn('avisos', 'motivo_rechazo')) {
                $table->dropColumn('motivo_rechazo');
            }
            if (Schema::hasColumn('avisos', 'fecha_aprobacion')) {
                $table->dropColumn('fecha_aprobacion');
            }
            if (Schema::hasColumn('avisos', 'fecha_expiracion')) {
                $table->dropColumn('fecha_expiracion');
            }
        });
    }
};

