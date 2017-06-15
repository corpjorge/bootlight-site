<?php

use Illuminate\Database\Seeder;
use App\Model\Sistema\Estado;

class EstadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new Estado();
        $user->tipo="Activado";
        $user->estilo="success";
        $user->save();
        $user = new Estado();
        $user->tipo="Desactivado";
        $user->estilo="danger";
        $user->save();

    }
}
