<?php

use Illuminate\Database\Seeder;
use App\Model\Usuario\Ciudad;
class CiudadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new Ciudad();
        $user->name="Bogota";
        $user->save();
    }
}
