<?php

use Illuminate\Database\Seeder;
use App\Model\Sistema\Area_item_admin;
class AreasitemsadminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new Area_item_admin();
        $user->area_admin_id="1";
        $user->name="Panel";
        $user->descripcion="Menu de inicio";
        $user->save();

        $user = new Area_item_admin();
        $user->area_admin_id="1";
        $user->name="Perfil";
        $user->descripcion="Menu de inicio";
        $user->save();

        $user = new Area_item_admin();
        $user->area_admin_id="2";
        $user->name="Proveedores";
        $user->descripcion="Venta de boleteria";
        $user->save();

        $user = new Area_item_admin();
        $user->area_admin_id="3";
        $user->name="Solicitudes";
        $user->descripcion="Tabla Solicitudes";
        $user->save();

        $user = new Area_item_admin();
        $user->area_admin_id="4";
        $user->name="Eventos";
        $user->descripcion="Eventos";
        $user->save();

        $user = new Area_item_admin();
        $user->area_admin_id="2";
        $user->name="Productos";
        $user->descripcion="Productos";
        $user->save();

        $user = new Area_item_admin();
        $user->area_admin_id="2";
        $user->name="Seriales";
        $user->descripcion="Seriales";
        $user->save();

        $user = new Area_item_admin();
        $user->area_admin_id="2";
        $user->name="Asignacion";
        $user->descripcion="Asignacion";
        $user->save();

        $user = new Area_item_admin();
        $user->area_admin_id="5";
        $user->name="Clasificados";
        $user->descripcion="Clasificados";
        $user->save();

        $user = new Area_item_admin();
        $user->area_admin_id="5";
        $user->name="PQRS";
        $user->descripcion="PQRS";
        $user->save();

        $user = new Area_item_admin();
        $user->area_admin_id="2";
        $user->name="Coordinador";
        $user->descripcion="Coordinador";
        $user->save();

        $user = new Area_item_admin();
        $user->area_admin_id="2";
        $user->name="Vender";
        $user->descripcion="Vender";
        $user->save();

        $user = new Area_item_admin();
        $user->area_admin_id="2";
        $user->name="Informe";
        $user->descripcion="Informe";
        $user->save();

        $user = new Area_item_admin();
        $user->area_admin_id="2";
        $user->name="Inventario";
        $user->descripcion="Inventario";
        $user->save();

        $user = new Area_item_admin();
        $user->area_admin_id="7";
        $user->name="Usuarios";
        $user->descripcion="Usuarios";
        $user->save();

    }
}
