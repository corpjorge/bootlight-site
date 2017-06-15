<?php

use Illuminate\Database\Seeder;
use App\Model\Usuario\Parentesco;

class ParentescoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new Parentesco();
        $user->tipo="HIJO";
        $user->save();

        $user = new Parentesco();
        $user->tipo="HIJA";
        $user->save();

        $user = new Parentesco();
        $user->tipo="HERMANO";
        $user->save();

        $user = new Parentesco();
        $user->tipo="HERMANA";
        $user->save();

        $user = new Parentesco();
        $user->tipo="PADRE";
        $user->save();

        $user = new Parentesco();
        $user->tipo="MADRE";
        $user->save();

        $user = new Parentesco();
        $user->tipo="TÍO";
        $user->save();

        $user = new Parentesco();
        $user->tipo="TÍA";
        $user->save();

        $user = new Parentesco();
        $user->tipo="ABUELO";
        $user->save();        

    }
}
