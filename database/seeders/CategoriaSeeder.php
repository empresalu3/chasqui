<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    public function run()
    {
        $categorias = [
            ['nombre'=>'Empleos','descripcion'=>'Ofertas de trabajo','estado'=>'activo'],
            ['nombre'=>'Compra/Venta','descripcion'=>'Productos y bienes usados o nuevos','estado'=>'activo'],
            ['nombre'=>'Alquileres','descripcion'=>'Inmuebles en alquiler','estado'=>'activo'],
            ['nombre'=>'Servicios','descripcion'=>'Servicios profesionales y técnicos','estado'=>'activo'],
            ['nombre'=>'Agenda Cultural','descripcion'=>'Eventos, ferias y talleres','estado'=>'activo'],
        ];

        DB::table('categorias')->insert(array_map(function($c){
            return array_merge($c, ['created_at'=>now(),'updated_at'=>now()]);
        }, $categorias));
    }
}
