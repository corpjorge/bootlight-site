<?php

use Illuminate\Database\Seeder;
use App\Model\Sistema\Alert_admin;
class alertsadminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new Alert_admin();
        $user->titulo="Bienvenido";
        $user->mensaje="Este es un mensaje de bienvenida por parte del administrador";
        $user->icono="fa-star";
        $user->estilo="alert-danger";
        $user->estado_id=2;
        $user->fecha_finalizacion="2017-03-21";
        $user->save();

    }
}
