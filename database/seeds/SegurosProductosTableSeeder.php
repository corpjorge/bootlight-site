<?php

use Illuminate\Database\Seeder;
use App\Model\Seguro\Seguros_producto;

class SegurosProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new Seguros_producto();
        $user->name="HOGAR";
        $user->descripcion="hogar";
        $user->ruta="seguros/solicitar";
        $user->icono="fa-home";
        $user->estilo="bg-aqua";
        $user->info="Texto de informacion sobre el producto - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam nec fringilla neque. Nunc ac mi nec neque aliquam malesuada vel nec ligula. Morbi nec pretium enim. Phasellus ultrices feugiat sem in varius.";
        $user->img="house.jpg";
        $user->estado_id="1";
        $user->save();

        $user = new Seguros_producto();
        $user->name="SOAT";
        $user->descripcion="soat";
        $user->ruta="seguros/solicitar";
        $user->icono="fa-motorcycle";
        $user->estilo="bg-teal";
        $user->info="Texto de informacion sobre el producto - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam nec fringilla neque. Nunc ac mi nec neque aliquam malesuada vel nec ligula. Morbi nec pretium enim. Phasellus ultrices feugiat sem in varius. ";
        $user->img="soat2.jpg";
        $user->estado_id="1";
        $user->save();

        $user = new Seguros_producto();
        $user->name="VEHICULO NUEVO";
        $user->descripcion="vehiculo nuevo";
        $user->ruta="seguros/solicitar";
        $user->icono="fa-car";
        $user->estilo="bg-olive";
        $user->info="Texto de informacion sobre el producto - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam nec fringilla neque. Nunc ac mi nec neque aliquam malesuada vel nec ligula. Morbi nec pretium enim. Phasellus ultrices feugiat sem in varius. ";
        $user->img="nuevo.jpg";
        $user->estado_id="1";
        $user->save();

        $user = new Seguros_producto();
        $user->name="VEHICULO USADO";
        $user->descripcion="vehiculo usado";
        $user->ruta="seguros/solicitar";
        $user->icono="fa-bus";
        $user->estilo="bg-yellow";
        $user->info="Texto de informacion sobre el producto - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam nec fringilla neque. Nunc ac mi nec neque aliquam malesuada vel nec ligula. Morbi nec pretium enim. Phasellus ultrices feugiat sem in varius. ";
        $user->img="usado.jpg";
        $user->estado_id="1";
        $user->save();


    }
}
