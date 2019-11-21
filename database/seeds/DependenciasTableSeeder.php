<?php

use Illuminate\Database\Seeder;
use App\Model\Sistema\Dependencia;

class DependenciasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = new Dependencia();
      $user->tipo='FONSODI';
      $user->save();

      $user = new Dependencia();
      $user->tipo='SODIMAC';
      $user->save();

      $user = new Dependencia();
      $user->tipo='DELIMA';
      $user->save();

    }
}
