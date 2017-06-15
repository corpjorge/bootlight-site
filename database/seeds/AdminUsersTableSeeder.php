<?php

use Illuminate\Database\Seeder;
use App\AdminUser;
class AdminUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = new AdminUser();
      $user->name = "admin";
      $user->email="admin@corpjorge.com";
      $user->password= crypt("111111","");
      $user->role_id=1;
      $user->save();

      $user = new AdminUser();
      $user->name = "peralta";
      $user->email="jorge.peralta@fyclsingenieria.com";
      $user->password= crypt("111111","");
      $user->role_id=1;
      $user->save();

    }
}
