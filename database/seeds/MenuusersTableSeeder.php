<?php

use Illuminate\Database\Seeder;
use App\Model\Sistema\Menu_user;

class MenuusersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = new Menu_user();
        $user->orden="1";
        $user->area_id="1";
        $user->icono="fa-home";
        $user->ruta="home";
        $user->estado_id="1";
        $user->estilo="bg-green";
        $user->save();

        $user = new Menu_user();
        $user->orden="2";
        $user->area_id="2";
        $user->icono="fa-ticket";
        $user->ruta="boleteria";
        $user->estado_id="1";
        $user->estilo="bg-aqua";
        $user->save();

        $user = new Menu_user();
        $user->orden="3";
        $user->area_id="3";
        $user->icono="fa-shield";
        $user->ruta="seguros";
        $user->estado_id="2";
        $user->estilo="bg-yellow";
        $user->save();

        $user = new Menu_user();
        $user->orden="4";
        $user->area_id="4";
        $user->icono="fa-calendar";
        $user->ruta="calendario";
        $user->estado_id="1";
        $user->estilo="bg-maroon";
        $user->save();

        $user = new Menu_user();
        $user->orden="5";
        $user->area_id="5";
        $user->icono="fa-mouse-pointer";
        $user->ruta="clasificados/add";
        $user->estado_id="1";
        $user->estilo="bg-teal";
        $user->save();

        $user = new Menu_user();
        $user->orden="6";
        $user->area_id="6";
        $user->icono="fa-heart-o";
        $user->ruta="pqrs";
        $user->estado_id="1";
        $user->estilo="bg-olive";
        $user->save();

        $user = new Menu_user();
        $user->orden="7";
        $user->area_id="7";
        $user->icono="fa-copyright";
        $user->ruta="claro";
        $user->estado_id="2";
        $user->estilo="bg-red";
        $user->save();

    }
}
