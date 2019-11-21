<?php

use Illuminate\Database\Seeder;
use App\Model\Sistema\Area;
class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new Area();
        $user->name="INICIO";
        $user->descripcion="Modulo de Inicio";
        $user->save();

        $user = new Area();
        $user->name="BOLETERIA";
        $user->descripcion="Modulo de Boletaria";
        $user->save();

        $user = new Area();
        $user->name="SEGUROS";
        $user->descripcion="Modulo de Seguros";
        $user->save();

        $user = new Area();
        $user->name="EVENTOS";
        $user->descripcion="Calendario";
        $user->save();

        $user = new Area();
        $user->name="CLASIFICADOS";
        $user->descripcion="Clasificados";
        $user->save();

        $user = new Area();
        $user->name="PQRS";
        $user->descripcion="PQRS";
        $user->save();

        $user = new Area();
        $user->name="CLARO";
        $user->descripcion="Modulo de Claro";
        $user->save();

    }
}
