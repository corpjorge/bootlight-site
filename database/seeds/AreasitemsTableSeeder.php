<?php

use Illuminate\Database\Seeder;
use App\Model\Sistema\Areas_item;

class AreasitemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new Areas_item();
        $user->area_id="1";
        $user->name="Panel";
        $user->descripcion="Panel";
        $user->save();

        $user = new Areas_item();
        $user->area_id="1";
        $user->name="Perfil";
        $user->descripcion="perfil";
        $user->save();

        $user = new Areas_item();
        $user->area_id="2";
        $user->name="Compras";
        $user->descripcion="Venta de boleteria";
        $user->save();

        $user = new Areas_item();
        $user->area_id="3";
        $user->name="Mis seguros";
        $user->descripcion="Tabla Solicitudes";
        $user->save();

        $user = new Areas_item();
        $user->area_id="3";
        $user->name="Solicitar";
        $user->descripcion="Solicitar";
        $user->save();

        $user = new Areas_item();
        $user->area_id="4";
        $user->name="Calendario";
        $user->descripcion="Calendario de Eventos";
        $user->save();

        $user = new Areas_item();
        $user->area_id="4";
        $user->name="Inscribirse";
        $user->descripcion="Inscribirse a Eventos";
        $user->save();

        $user = new Areas_item();
        $user->area_id="5";
        $user->name="Clasificados";
        $user->descripcion="Clasificados";
        $user->save();

        $user = new Areas_item();
        $user->area_id="6";
        $user->name="PQRS";
        $user->descripcion="PQRS";
        $user->save();

        $user = new Areas_item();
        $user->area_id="6";
        $user->name="Boletería";
        $user->descripcion="Boletería";
        $user->save();

    }
}
