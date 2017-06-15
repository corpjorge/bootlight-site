<?php

use Illuminate\Database\Seeder;
use App\Model\Usuario\Estado_civil;
class Estado_civilTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = new Estado_civil();
      $user->tipo = "Casado (a)";
      $user->save();
      $user = new Estado_civil();
      $user->tipo = "Soltero(A)";
      $user->save();
      $user = new Estado_civil();
      $user->tipo = "Union Libre";
      $user->save();
      $user = new Estado_civil();
      $user->tipo = "Viudo";
      $user->save();
      $user = new Estado_civil();
      $user->tipo = "Divorciado";
      $user->save();
      $user = new Estado_civil();
      $user->tipo = "Otros";
      $user->save();
      $user = new Estado_civil();
      $user->tipo = "Otros";
      $user->save();
      $user = new Estado_civil();
      $user->tipo = "Varios";
      $user->save();
      $user = new Estado_civil();
      $user->tipo = "Sin descripcion";
      $user->save();
    }
}
