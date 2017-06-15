<?php

use Illuminate\Database\Seeder;
use App\Model\Sistema\Correo_notication;
class CorreoNotificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = new Correo_notication();
        $user->area_admin_id=3;
        $user->admin_user_id=1;
        $user->dependencia_id=1;
        $user->save();

        $user = new Correo_notication();
        $user->area_admin_id=3;
        $user->admin_user_id=1;
        $user->dependencia_id=2;
        $user->save();

        $user = new Correo_notication();
        $user->area_admin_id=3;
        $user->admin_user_id=1;
        $user->dependencia_id=3;
        $user->save();
    }
}
