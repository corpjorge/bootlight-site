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
      $user->valor="1.4";
      $user->anual="18.16";
      $user->plazo_inicial="0";
      $user->plazo_final="0";
      $user->save();

      $user = new Simuladortasa();
      $user->simulador_linea_id="2";
      $user->valor="1.2";
      $user->anual="15.39";
      $user->plazo_inicial="1";
      $user->plazo_final="12";
      $user->save();

      $user = new Simuladortasa();
      $user->simulador_linea_id="2";
      $user->valor="1.3";
      $user->anual="16.77";
      $user->plazo_inicial="13";
      $user->plazo_final="24";
      $user->save();

      $user = new Simuladortasa();
      $user->simulador_linea_id="2";
      $user->valor="1.5";
      $user->anual="19.56";
      $user->plazo_inicial="25";
      $user->plazo_final="36";
      $user->save();

      $user = new Simuladortasa();
      $user->simulador_linea_id="3";
      $user->valor="0.9";
      $user->anual="11.35";
      $user->plazo_inicial="1";
      $user->plazo_final="36";
      $user->save();

      $user = new Simuladortasa();
      $user->simulador_linea_id="4";
      $user->valor="1.2";
      $user->anual="15.39";
      $user->plazo_inicial="1";
      $user->plazo_final="36";
      $user->save();

      $user = new Simuladortasa();
      $user->simulador_linea_id="5";
      $user->valor="0.6";
      $user->anual="7.44";
      $user->plazo_inicial="1";
      $user->plazo_final="24";
      $user->save();

      $user = new Simuladortasa();
      $user->simulador_linea_id="6";
      $user->valor="0.8";
      $user->anual="10.03";
      $user->plazo_inicial="1";
      $user->plazo_final="36";
      $user->save();

      $user = new Simuladortasa();
      $user->simulador_linea_id="7";
      $user->valor="1.0";
      $user->anual="12.68";
      $user->plazo_inicial="1";
      $user->plazo_final="120";
      $user->save();

      $user = new Simuladortasa();
      $user->simulador_linea_id="8";
      $user->valor="1.0";
      $user->anual="12.68";
      $user->plazo_inicial="1";
      $user->plazo_final="60";
      $user->save();

      $user = new Simuladortasa();
      $user->simulador_linea_id="9";
      $user->valor="1.0";
      $user->anual="12.68";
      $user->plazo_inicial="1";
      $user->plazo_final="120";
      $user->save();

      $user = new Simuladortasa();
      $user->simulador_linea_id="10";
      $user->valor="0.85";
      $user->anual="10.69";
      $user->plazo_inicial="1";
      $user->plazo_final="60";
      $user->save();

      $user = new Simuladortasa();
      $user->simulador_linea_id="11";
      $user->valor="1.2";
      $user->anual="15.39";
      $user->plazo_inicial="1";
      $user->plazo_final="12";
      $user->save();

    }
}
