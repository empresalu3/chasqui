<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ExpirarAvisos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:expirar-avisos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
{
    $avisos = Aviso::where('estado_publicacion', 'aprobado')
        ->whereDate('fecha_expiracion', '<', now())
        ->update(['estado_publicacion' => 'expirado']);

    $this->info(' Avisos expirados actualizados.');
}

}
