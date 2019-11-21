<?php

use Illuminate\Database\Seeder;
use App\Model\Simulador\SimuladorLinea;

class SimuladorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = new SimuladorLinea();
      $user->name="Anticipo de prima";
      $user->observacion="Pago único";
      $user->save();

      $user = new SimuladorLinea();
      $user->name="Libre inversión";
      $user->observacion="Plazo en meses de 1 a 36";
      $user->save();

      $user = new SimuladorLinea();
      $user->name="Consumo compra de cartera";
      $user->observacion="Plazo en meses de 1 a 36";
      $user->save();

      $user = new SimuladorLinea();
      $user->name="Consumos proveedores";
      $user->observacion="Plazo en meses de 1 a 36";
      $user->save();

      $user = new SimuladorLinea();
      $user->name="Solidario";
      $user->observacion="Plazo en meses de 1 a 24";
      $user->save();

      $user = new SimuladorLinea();
      $user->name="Educación";
      $user->observacion="El alcance del crédito se extenderá a costos por matricula de hijos o cónyuge.";
      $user->save();

      $user = new SimuladorLinea();
      $user->name="Vivienda nueva o usada";
      $user->observacion="Se presta hasta el 85% de la vivienda, hipoteca abierta en primer grado según el monto; ingresos familiares ";
      $user->save();

      $user = new SimuladorLinea();
      $user->name="Vivienda - remodelación";
      $user->observacion="Se presta hasta el 100% del costo de la remodelación, hipoteca abierta en primer grado, que no esté como patrimonio de familia, según el monto; ingresos familiares";
      $user->save();

      $user = new SimuladorLinea();
      $user->name="Liberación hipoteca";
      $user->observacion="Se presta hasta el 100% de la cartera hipotecaria, hipoteca abierta en primer grado según el monto; ingresos familiares";
      $user->save();

      $user = new SimuladorLinea();
      $user->name="Vehículo";
      $user->observacion="Se presta hasta el 80% del vehículo nuevo y 70% para vehículo usado siempre y cuando el vehículo sea asegurable.";
      $user->save();

      $user = new SimuladorLinea();
      $user->name="Soat";
      $user->observacion="Plazo en meses de 1 a 12";
      $user->save();

    }
}
