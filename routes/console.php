<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function () {
    // Desactivar avisos expirados
    Aviso::where('estado', 'activo')
        ->whereDate('fecha_expiracion', '<', now())
        ->update(['estado' => 'inactivo']);
})->daily(); // se ejecutará una vez al día
