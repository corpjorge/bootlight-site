<?php

use Illuminate\Database\Seeder;
use App\Model\Usuario\Almacen;
class AlmacenesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new Almacen();
        $user->name="Oat";
        $user->direccion="Calle 1 # 2 - 3";
        $user->ciudades_id="1";
        $user->save();
    }
}
