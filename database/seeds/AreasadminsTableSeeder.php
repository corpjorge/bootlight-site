<?php

use Illuminate\Database\Seeder;
use App\Model\Sistema\Area_admin;
class AreasadminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = new Area_admin();
      $user->name="INICIO";
      $user->descripcion="Administrador de Inicio";
      $user->save();

      $user = new Area_admin();
      $user->name="BOLETERIA";
      $user->descripcion="Administrador de Boletaria";
      $user->save();

      $user = new Area_admin();
      $user->name="SEGUROS";
      $user->descripcion="Administrador de Seguros";
      $user->save();

      $user = new Area_admin();
      $user->name="EVENTOS";
      $user->descripcion="Calendario";
      $user->save();

      $user = new Area_admin();
      $user->name="SERVICIOS";
      $user->descripcion="Clasificados / PQRS";
      $user->save();

      $user = new Area_admin();
      $user->name="CLARO";
      $user->descripcion="Administrador de claro";
      $user->save();

      $user = new Area_admin();
      $user->name="CONFIGURACIÓN";
      $user->descripcion="Configuración";
      $user->save();

    }
}
