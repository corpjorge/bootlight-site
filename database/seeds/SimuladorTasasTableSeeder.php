<?php

use Illuminate\Database\Seeder;
use App\Model\Simulador\Simuladortasa;

class SimuladorTasasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = new Simuladortasa();
      $user->simulador_linea_id="1";
      $user->valor="18.16";
      $user->plazo_inicial="0";
      $user->plazo_final="0";
      $user->save();

      $user = new Simuladortasa();
      $user->simulador_linea_id="2";
      $user->valor="15.39";
      $user->plazo_inicial="1";
      $user->plazo_final="12";
      $user->save();

      $user = new Simuladortasa();
      $user->simulador_linea_id="2";
      $user->valor="16.77";
      $user->plazo_inicial="13";
      $user->plazo_final="24";
      $user->save();

      $user = new Simuladortasa();
      $user->simulador_linea_id="2";
      $user->valor="19.56";
      $user->plazo_inicial="25";
      $user->plazo_final="36";
      $user->save();

      $user = new Simuladortasa();
      $user->simulador_linea_id="3";
      $user->valor="11.35";
      $user->plazo_inicial="1";
      $user->plazo_final="36";
      $user->save();

      $user = new Simuladortasa();
      $user->simulador_linea_id="4";
      $user->valor="15.39";
      $user->plazo_inicial="1";
      $user->plazo_final="36";
      $user->save();

      $user = new Simuladortasa();
      $user->simulador_linea_id="5";
      $user->valor="7.44";
      $user->plazo_inicial="1";
      $user->plazo_final="24";
      $user->save();

      $user = new Simuladortasa();
      $user->simulador_linea_id="6";
      $user->valor="10.03";
      $user->plazo_inicial="1";
      $user->plazo_final="36";
      $user->save();

      $user = new Simuladortasa();
      $user->simulador_linea_id="7";
      $user->valor="12.68";
      $user->plazo_inicial="1";
      $user->plazo_final="120";
      $user->save();

      $user = new Simuladortasa();
      $user->simulador_linea_id="8";
      $user->valor="12.68";
      $user->plazo_inicial="1";
      $user->plazo_final="60";
      $user->save();

      $user = new Simuladortasa();
      $user->simulador_linea_id="9";
      $user->valor="12.68";
      $user->plazo_inicial="1";
      $user->plazo_final="120";
      $user->save();

      $user = new Simuladortasa();
      $user->simulador_linea_id="10";
      $user->valor="10.69";
      $user->plazo_inicial="1";
      $user->plazo_final="60";
      $user->save();

      $user = new Simuladortasa();
      $user->simulador_linea_id="11";
      $user->valor="15.39";
      $user->plazo_inicial="1";
      $user->plazo_final="12";
      $user->save();

    }
}
