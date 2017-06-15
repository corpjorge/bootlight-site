<?php

use Illuminate\Database\Seeder;
use App\Model\Sistema\Menu_admin;
class MenuaadminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = new Menu_admin();
      $user->orden="1";
      $user->area_admin_id="1";
      $user->icono="fa-home";
      $user->ruta="admin_home";
      $user->estado_id="1";
      $user->estilo="bg-green";
      $user->save();

      $user = new Menu_admin();
      $user->orden="2";
      $user->area_admin_id="2";
      $user->icono="fa-ticket";
      $user->ruta="admin_boleteria";
      $user->estado_id="1";
      $user->estilo="bg-aqua";
      $user->save();

      $user = new Menu_admin();
      $user->orden="3";
      $user->area_admin_id="3";
      $user->icono="fa-shield";
      $user->ruta="admin_seguros";
      $user->estado_id="1";
      $user->estilo="bg-yellow";
      $user->save();

      $user = new Menu_admin();
      $user->orden="4";
      $user->area_admin_id="4";
      $user->icono="fa-calendar";
      $user->ruta="admin_evento";
      $user->estado_id="1";
      $user->estilo="bg-red";
      $user->save();

      $user = new Menu_admin();
      $user->orden="5";
      $user->area_admin_id="5";
      $user->icono="fa-heart-o";
      $user->ruta="admin_servicios";
      $user->estado_id="1";
      $user->estilo="bg-teal";
      $user->save();

      $user = new Menu_admin();
      $user->orden="6";
      $user->area_admin_id="6";
      $user->icono="fa-copyright";
      $user->ruta="admin_claro";
      $user->estado_id="1";
      $user->estilo="bg-red";
      $user->save();

      $user = new Menu_admin();
      $user->orden="999";
      $user->area_admin_id="7";
      $user->icono="fa-gears";
      $user->ruta="admin_config";
      $user->estado_id="1";
      $user->estilo="bg-navy";
      $user->save();

    }
}
