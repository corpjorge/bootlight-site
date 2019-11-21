<?php

use Illuminate\Database\Seeder;
use App\Model\Sistema\Rol;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new Rol();
        $user->name="super admin";
        $user->descripcion="Control total";
        $user->save();

        $user = new Rol();
        $user->name="administrador";
        $user->descripcion="Control superior";
        $user->save();

        $user = new Rol();
        $user->name="gerente";
        $user->descripcion="gerente";
        $user->save();

        $user = new Rol();
        $user->name="subgerente";
        $user->descripcion="Sub gerente";
        $user->save();

        $user = new Rol();
        $user->name="director";
        $user->descripcion="director";
        $user->save();

        $user = new Rol();
        $user->name="jefe";
        $user->descripcion="jefe";
        $user->save();

        $user = new Rol();
        $user->name="coordinador";
        $user->descripcion="coordinador";
        $user->save();

        $user = new Rol();
        $user->name="auxiliar";
        $user->descripcion="auxiliar";
        $user->save();

        $user = new Rol();
        $user->name="asistente";
        $user->descripcion="asistente";
        $user->save();

        $user = new Rol();
        $user->name="asociado";
        $user->descripcion="Rol solo para los asociados";
        $user->save();

        $user = new Rol();
        $user->name="colaborador";
        $user->descripcion="Rol solo para los colaboradores de sodimac";
        $user->save();

        $user = new Rol();
        $user->name="publico";
        $user->descripcion="No es necesario registrarse";
        $user->save();




    }
}
