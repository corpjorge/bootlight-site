<?php

use Illuminate\Database\Seeder;
use App\Model\Sistema\Estados_aprobacion;

class EstadosAprobacioneTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new Estados_aprobacion();
        $user->tipo="Aprobado";
        $user->estilo="success";
        $user->save();
        $user = new Estados_aprobacion();
        $user->tipo="Negado";
        $user->estilo="danger";
        $user->save();
        $user = new Estados_aprobacion();
        $user->tipo="Pendiente";
        $user->estilo="warning";
        $user->save();
        $user = new Estados_aprobacion();
        $user->tipo="Documentos faltantes";
        $user->estilo="danger";
        $user->save();
        $user = new Estados_aprobacion();
        $user->tipo="Vendido";
        $user->estilo="info";
        $user->save();
    }
}
