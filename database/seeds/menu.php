<?php

use Illuminate\Database\Seeder;
use App\Model\Sistema\Area;
use App\Model\Sistema\Areas_item;
use App\Model\Sistema\Menu_user;
use App\Model\Sistema\Menu_users_sub;

use App\Model\Sistema\Area_admin;
use App\Model\Sistema\Area_item_admin;
use App\Model\Sistema\Menu_admin;
use App\Model\Sistema\Menu_admin_sub;

use App\Model\Sistema\Estados_aprobacion;



class menu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $area = new Area();
        $area->name='PRODUCTO';
        $area->descripcion='Solicite su producto';
        $area->save();

        $Area_item = new Areas_item();
        $Area_item->area_id=8;
        $Area_item->name='Mis productos';
        $Area_item->descripcion='';
        $Area_item->save();

        $Area_item = new Areas_item();
        $Area_item->area_id=8;
        $Area_item->name='Solicitar';
        $Area_item->descripcion='';
        $Area_item->save();

        $Menu_user = new Menu_user();
        $Menu_user->orden=8;
        $Menu_user->area_id=8;
        $Menu_user->icono='fa-codepen';
        $Menu_user->ruta='solicitud/productos';
        $Menu_user->estado_id=1;
        $Menu_user->estilo='bg-red';
        $Menu_user->save();

        $Menu_users_sub = new Menu_users_sub();
        $Menu_users_sub->menu_user_id=8;
        $Menu_users_sub->orden=1;
        $Menu_users_sub->areas_item_id=11;
        $Menu_users_sub->icono='';
        $Menu_users_sub->ruta='solicitud/productos';
        $Menu_users_sub->estado_id=1;
        $Menu_users_sub->estilo='';
        $Menu_users_sub->save();

        $Menu_users_sub = new Menu_users_sub();
        $Menu_users_sub->menu_user_id=8;
        $Menu_users_sub->orden=2;
        $Menu_users_sub->areas_item_id=12;
        $Menu_users_sub->icono='';
        $Menu_users_sub->ruta='solicitud/solicitar';
        $Menu_users_sub->estado_id=1;
        $Menu_users_sub->estilo='';        
        $Menu_users_sub->save();

        $Estados_aprobacion = new Estados_aprobacion();
        $Estados_aprobacion->tipo='Desembolsado ';
        $Estados_aprobacion->estilo='info';
        $Estados_aprobacion->save();


///////////////////////


        $Area_admin = new Area_admin();
        $Area_admin->name='PRODUCTO';
        $Area_admin->descripcion='Productos Solicitados';
        $Area_admin->save();

        $Area_item = new Area_item_admin();
        $Area_item->area_admin_id=8;
        $Area_item->name='Solicitudes';
        $Area_item->descripcion='';
        $Area_item->save();

        $Area_item = new Area_item_admin();
        $Area_item->area_admin_id=8;
        $Area_item->name='Productos';
        $Area_item->descripcion='';
        $Area_item->save();

        $Area_item = new Area_item_admin();
        $Area_item->area_admin_id=8;
        $Area_item->name='Desembolso';
        $Area_item->descripcion='';
        $Area_item->save();

        $Menu_admin = new Menu_admin();
        $Menu_admin->orden=8;
        $Menu_admin->area_admin_id=8;
        $Menu_admin->icono='fa-codepen';
        $Menu_admin->ruta='solicitudes/solicitados';
        $Menu_admin->estado_id=1;
        $Menu_admin->estilo='bg-red';
        $Menu_admin->save();

        $Menu_users_sub = new Menu_admin_sub();
        $Menu_users_sub->menu_admin_id=8;
        $Menu_users_sub->orden=1;
        $Menu_users_sub->areas_item_admin_id=25;
        $Menu_users_sub->icono='';
        $Menu_users_sub->ruta='solicitudes/solicitados';
        $Menu_users_sub->estado_id=1;
        $Menu_users_sub->estilo='';
        $Menu_users_sub->role_id=7;
        $Menu_users_sub->save();

        $Menu_users_sub = new Menu_admin_sub();
        $Menu_users_sub->menu_admin_id=8;
        $Menu_users_sub->orden=2;
        $Menu_users_sub->areas_item_admin_id=26;
        $Menu_users_sub->icono='';
        $Menu_users_sub->ruta='solicitudes/productos';
        $Menu_users_sub->estado_id=1;
        $Menu_users_sub->estilo='';
        $Menu_users_sub->role_id=7;
        $Menu_users_sub->save();

        $Menu_users_sub = new Menu_admin_sub();
        $Menu_users_sub->menu_admin_id=8;
        $Menu_users_sub->orden=3;
        $Menu_users_sub->areas_item_admin_id=27;
        $Menu_users_sub->icono='';
        $Menu_users_sub->ruta='solicitudes/desembolso';
        $Menu_users_sub->estado_id=1;
        $Menu_users_sub->estilo='';
        $Menu_users_sub->role_id=8;
        $Menu_users_sub->save();


    }
}
