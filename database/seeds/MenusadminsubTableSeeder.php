<?php

use Illuminate\Database\Seeder;
use App\Model\Sistema\Menu_admin_sub;
class MenusadminsubTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new Menu_admin_sub();
        $user->menu_admin_id="1";
        $user->orden="1";
        $user->areas_item_admin_id="1";
        $user->icono="fa-bell";
        $user->ruta="admin_home";
        $user->estado_id="1";
        $user->estilo="bg-aqua";
        $user->role_id="9";
        $user->save();

        $user = new Menu_admin_sub();
        $user->menu_admin_id="1";
        $user->orden="2";
        $user->areas_item_admin_id="2";
        $user->icono="fa-bell";
        $user->ruta="admin_perfil";
        $user->estado_id="1";
        $user->estilo="bg-aqua";
        $user->role_id="9";
        $user->save();

        $user = new Menu_admin_sub();
        $user->menu_admin_id="2";
        $user->orden="6";
        $user->areas_item_admin_id="3";
        $user->icono="fa-bell";
        $user->ruta="admin_boleteria/proveedores";
        $user->estado_id="1";
        $user->estilo="bg-aqua";
        $user->role_id="2";
        $user->save();

        $user = new Menu_admin_sub();
        $user->menu_admin_id="3";
        $user->orden="1";
        $user->areas_item_admin_id="4";
        $user->icono="fa-diamont";
        $user->ruta="admin_seguros";
        $user->estado_id="1";
        $user->estilo="bg-yellow";
        $user->role_id="2";
        $user->save();

        $user = new Menu_admin_sub();
        $user->menu_admin_id="4";
        $user->orden="1";
        $user->areas_item_admin_id="5";
        $user->icono="";
        $user->ruta="admin_evento";
        $user->estado_id="1";
        $user->estilo="";
        $user->role_id="6";
        $user->save();

        $user = new Menu_admin_sub();
        $user->menu_admin_id="2";
        $user->orden="5";
        $user->areas_item_admin_id="6";
        $user->icono=" ";
        $user->ruta="admin_boleteria/productos";
        $user->estado_id="1";
        $user->estilo=" ";
        $user->role_id="2";
        $user->save();

        $user = new Menu_admin_sub();
        $user->menu_admin_id="2";
        $user->orden="4";
        $user->areas_item_admin_id="7";
        $user->icono=" ";
        $user->ruta="admin_boleteria/seriales";
        $user->estado_id="1";
        $user->estilo=" ";
        $user->role_id="2";
        $user->save();

        $user = new Menu_admin_sub();
        $user->menu_admin_id="2";
        $user->orden="3";
        $user->areas_item_admin_id="8";
        $user->icono=" ";
        $user->ruta="admin_boleteria/asignacion";
        $user->estado_id="1";
        $user->estilo=" ";
        $user->role_id="2";
        $user->save();

        $user = new Menu_admin_sub();
        $user->menu_admin_id="5";
        $user->orden="1";
        $user->areas_item_admin_id="9";
        $user->icono=" ";
        $user->ruta="admin_servicios/clasificados";
        $user->estado_id="1";
        $user->estilo=" ";
        $user->role_id="6";
        $user->save();

        $user = new Menu_admin_sub();
        $user->menu_admin_id="5";
        $user->orden="2";
        $user->areas_item_admin_id="10";
        $user->icono="";
        $user->ruta="admin_servicios/pqrs";
        $user->estado_id="1";
        $user->estilo=" ";
        $user->role_id="6";
        $user->save();

        $user = new Menu_admin_sub();
        $user->menu_admin_id="2";
        $user->orden="2";
        $user->areas_item_admin_id="11";
        $user->icono="";
        $user->ruta="admin_boleteria/coordinador";
        $user->estado_id="1";
        $user->estilo=" ";
        $user->role_id="7";
        $user->save();

        $user = new Menu_admin_sub();
        $user->menu_admin_id="2";
        $user->orden="1";
        $user->areas_item_admin_id="12";
        $user->icono="";
        $user->ruta="admin_boleteria/vender";
        $user->estado_id="1";
        $user->estilo=" ";
        $user->role_id="7";
        $user->save();

        $user = new Menu_admin_sub();
        $user->menu_admin_id="2";
        $user->orden="0";
        $user->areas_item_admin_id="13";
        $user->icono="";
        $user->ruta="admin_boleteria";
        $user->estado_id="1";
        $user->estilo=" ";
        $user->role_id="7";
        $user->save();

        $user = new Menu_admin_sub();
        $user->menu_admin_id="2";
        $user->orden="7";
        $user->areas_item_admin_id="14";
        $user->icono="";
        $user->ruta="admin_boleteria/inventario";
        $user->estado_id="1";
        $user->estilo=" ";
        $user->role_id="2";
        $user->save();

        $user = new Menu_admin_sub();
        $user->menu_admin_id="7";
        $user->orden="1";
        $user->areas_item_admin_id="15";
        $user->icono="";
        $user->ruta="admin_config/user";
        $user->estado_id="1";
        $user->estilo=" ";
        $user->role_id="2";
        $user->save();

        $user = new Menu_admin_sub();
        $user->menu_admin_id="7";
        $user->orden="2";
        $user->areas_item_admin_id="16";
        $user->icono="";
        $user->ruta="admin_config/permisos";
        $user->estado_id="1";
        $user->estilo=" ";
        $user->role_id="2";
        $user->save();

        $user = new Menu_admin_sub();
        $user->menu_admin_id="7";
        $user->orden="3";
        $user->areas_item_admin_id="17";
        $user->icono="";
        $user->ruta="admin_config/areas";
        $user->estado_id="1";
        $user->estilo=" ";
        $user->role_id="2";
        $user->save();

        $user = new Menu_admin_sub();
        $user->menu_admin_id="7";
        $user->orden="4";
        $user->areas_item_admin_id="18";
        $user->icono="";
        $user->ruta="admin_config/areas_items";
        $user->estado_id="1";
        $user->estilo=" ";
        $user->role_id="2";
        $user->save();

        $user = new Menu_admin_sub();
        $user->menu_admin_id="7";
        $user->orden="5";
        $user->areas_item_admin_id="19";
        $user->icono="";
        $user->ruta="admin_config/areas_admin";
        $user->estado_id="1";
        $user->estilo=" ";
        $user->role_id="2";
        $user->save();

        $user = new Menu_admin_sub();
        $user->menu_admin_id="7";
        $user->orden="6";
        $user->areas_item_admin_id="20";
        $user->icono="";
        $user->ruta="admin_config/areas_admin_items";
        $user->estado_id="1";
        $user->estilo=" ";
        $user->role_id="2";
        $user->save();

        $user = new Menu_admin_sub();
        $user->menu_admin_id="7";
        $user->orden="7";
        $user->areas_item_admin_id="21";
        $user->icono="";
        $user->ruta="admin_config/menu";
        $user->estado_id="1";
        $user->estilo=" ";
        $user->role_id="2";
        $user->save();

        $user = new Menu_admin_sub();
        $user->menu_admin_id="7";
        $user->orden="8";
        $user->areas_item_admin_id="22";
        $user->icono="";
        $user->ruta="admin_config/sub_menu";
        $user->estado_id="1";
        $user->estilo=" ";
        $user->role_id="2";
        $user->save();

        $user = new Menu_admin_sub();
        $user->menu_admin_id="7";
        $user->orden="9";
        $user->areas_item_admin_id="23";
        $user->icono="";
        $user->ruta="admin_config/menu_admin";
        $user->estado_id="1";
        $user->estilo=" ";
        $user->role_id="2";
        $user->save();

        $user = new Menu_admin_sub();
        $user->menu_admin_id="7";
        $user->orden="10";
        $user->areas_item_admin_id="24";
        $user->icono="";
        $user->ruta="admin_config/sub_menu_admin";
        $user->estado_id="1";
        $user->estilo=" ";
        $user->role_id="2";
        $user->save();



    }
}
