<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use Auth;
use App\Model\Sistema\Menu_user;
use App\Model\Sistema\Menu_users_sub;
use App\Model\Sistema\Alert_admin;
use App\Model\Usuario\Users_detalle;
use App\Model\Sistema\Menu_admin;
use App\Model\Sistema\Menu_admin_sub;
use App\AdminUser;
use App\Model\Sistema\Permiso;
use Illuminate\Support\Facades\Route;


class VariablesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //setlocale(LC_TIME, 'German');
        $carbon           = new \Carbon\Carbon();
        \Carbon\Carbon::setLocale('es');

        $menu_users      = Menu_user::all()->sortBy("orden");
        $menu_users_subs = Menu_users_sub::all()->sortBy("orden");
        $alert_admins    = Alert_admin::all();
        $cumples         = Users_detalle::all();
        $menu_admin_subs = Menu_admin_sub::all()->sortBy("orden");
        $menu_admins     = Menu_admin::all()->sortBy("orden");

        View::share('menu_users', $menu_users);
        View::share('menu_users_subs', $menu_users_subs);
        View::share('alert_admins', $alert_admins);
        View::share('carbon', $carbon);
        View::share('cumples', $cumples);
        View::share('menu_admin_subs', $menu_admin_subs);
        View::share('menu_admins', $menu_admins);   
        //Auth::guard('admin_user')->user()->id

        if (Auth::check()) {}
          $adminpermisos   = Permiso::all();
          View::share('adminpermisos', $adminpermisos);

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
