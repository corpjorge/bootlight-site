<?php

use Illuminate\Database\Seeder;
use App\Model\Usuario\Estado_vinculacion;
class Estado_vinculacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new Estado_vinculacion();
        $user->tipo="ACTIVO";
        $user->save();
        $user = new Estado_vinculacion();
        $user->tipo="RETIRADO";
        $user->save();
    }
}
