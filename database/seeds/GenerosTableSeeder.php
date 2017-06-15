<?php

use Illuminate\Database\Seeder;
use App\Model\Usuario\Genero;
class GenerosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new Genero();
        $user->tipo="M";
        $user->name="Masculino";
        $user->save();
        $user = new Genero();
        $user->tipo="F";
        $user->name="Femenino";
        $user->save();
    }
}
