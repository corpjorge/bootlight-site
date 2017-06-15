<?php

use Illuminate\Database\Seeder;
use App\Model\Usuario\Documento_tipo;

class Documento_tiposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new Documento_tipo();
        $user->tipo = "NIT";
        $user->descripcion = "NIT";
        $user->save();
        $user = new Documento_tipo();
        $user->tipo = "Cédula de Ciudadanía";
        $user->descripcion = "Cédula de Ciudadanía";
        $user->save();
        $user = new Documento_tipo();
        $user->tipo = "Cédula de Extranjería";
        $user->descripcion = "Cédula de Extranjería";
        $user->save();
        $user = new Documento_tipo();
        $user->tipo = "Tarjeta de identidad";
        $user->descripcion = "Tarjeta de identidad";
        $user->save();
        $user = new Documento_tipo();
        $user->tipo = "Registro civil de nacimiento";
        $user->descripcion = "Registro civil de nacimiento";
        $user->save();


    }
}
