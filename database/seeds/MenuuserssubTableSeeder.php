<?php

use Illuminate\Database\Seeder;
use App\Model\Sistema\Menu_users_sub;
class MenuuserssubTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $user = new Menu_users_sub();
      $user->menu_user_id="1";
      $user->orden="1";
      $user->areas_item_id="1";
      $user->icono="fa-bell";
      $user->ruta="home";
      $user->estado_id="1";
      $user->estilo="bg-aqua";
      $user->save();

      $user = new Menu_users_sub();
      $user->menu_user_id="1";
      $user->orden="2";
      $user->areas_item_id="2";
      $user->icono="fa-bell";
      $user->ruta="perfil";
      $user->estado_id="1";
      $user->estilo="bg-aqua";
      $user->save();

      $user = new Menu_users_sub();
      $user->menu_user_id="2";
      $user->orden="1";
      $user->areas_item_id="3";
      $user->icono="fa-bell";
      $user->ruta="boleteria";
      $user->estado_id="2";
      $user->estilo="bg-aqua";
      $user->save();

      $user = new Menu_users_sub();
      $user->menu_user_id="3";
      $user->orden="1";
      $user->areas_item_id="4";
      $user->icono="fa-bell";
      $user->ruta="seguros";
      $user->estado_id="1";
      $user->estilo="bg-yellow";
      $user->save();

      $user = new Menu_users_sub();
      $user->menu_user_id="3";
      $user->orden="2";
      $user->areas_item_id="5";
      $user->icono="";
      $user->ruta="seguros/solicitar";
      $user->estado_id="1";
      $user->estilo="";
      $user->save();

      $user = new Menu_users_sub();
      $user->menu_user_id="4";
      $user->orden="1";
      $user->areas_item_id="6";
      $user->icono="";
      $user->ruta="calendario";
      $user->estado_id="1";
      $user->estilo="";
      $user->save();

      $user = new Menu_users_sub();
      $user->menu_user_id="4";
      $user->orden="2";
      $user->areas_item_id="7";
      $user->icono="";
      $user->ruta="inscripcion";
      $user->estado_id="1";
      $user->estilo="";
      $user->save();

      $user = new Menu_users_sub();
      $user->menu_user_id="5";
      $user->orden="2";
      $user->areas_item_id="8";
      $user->icono="fa-mouse-pointer";
      $user->ruta="clasificados/add";
      $user->estado_id="1";
      $user->estilo="bg-aqua";
      $user->save();

      $user = new Menu_users_sub();
      $user->menu_user_id="6";
      $user->orden="3";
      $user->areas_item_id="9";
      $user->icono="fa-fax";
      $user->ruta="pqrs";
      $user->estado_id="1";
      $user->estilo="bg-yellow";
      $user->save();

      $user = new Menu_users_sub();
      $user->menu_user_id="2";
      $user->orden="0";
      $user->areas_item_id="10";
      $user->icono="fa-fax";
      $user->ruta="boleteria";
      $user->estado_id="1";
      $user->estilo="bg-yellow";
      $user->save();

     }
}
