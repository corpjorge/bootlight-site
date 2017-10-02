<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return view('welcome');
});

/// USUARIO
Route::post('login_ws', 'Usuario\LoginController@login_ws');
Route::group(['middleware' => 'auth'], function () {
    //    Route::get('/link1', function ()    {
    //        // Uses Auth Middleware
    //    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes

    Route::get('perfil', 'Usuario\Users_detalleController@index');
    Route::get('noasicado', 'Usuario\NoasociadoController@index');
    Route::get('error404', 'Usuario\NoasociadoController@error');
    Route::get('help', 'Usuario\Users_detalleController@help');
    Route::get('atencion', 'Usuario\LoginController@loginAtencion');

    Route::group(['middleware' => 'asociado'], function () {
        Route::get('transferencia', 'Usuario\Users_detalleController@transferencia');

        Route::get('servicios', 'Servicio\ServicioController@index');
        Route::get('clasificados/add', 'Servicio\ClasificadoController@create');
        Route::post('clasificados/add', 'Servicio\ClasificadoController@store');
        Route::get('pqrs', 'Servicio\PqrsController@index');
        Route::post('pqrs/add', 'Servicio\PqrsController@store');

        Route::get('calendario', 'Evento\EventoController@indexcalendario');
        Route::resource('events', 'Evento\EventoController');
        Route::get('inscripcion', 'Evento\EventoController@inscrip');
        Route::get('inscripcion/{id}', 'Evento\EventoController@show');
        Route::get('inscripcion/add/{id}', 'Evento\EventoController@inscripcion');

        Route::get('boleteria', 'Usuario\BoleteriaController@index');
        Route::get('boleteria/ver/{id}', 'Usuario\BoleteriaController@show');
        Route::get('boleteria/ver/pdf/{id}', 'Usuario\BoleteriaController@imp');
        Route::get('boleteria/productos/add', 'Usuario\BoleteriaController@create');
        Route::post('boleteria/productos/add', 'Usuario\BoleteriaController@store');
    });

    Route::get('seguros', 'Seguro\SolicitudController@segurosvista');
    Route::get('seguros/solicitar', 'Seguro\SolicitudController@index');
    Route::get('seguros/ver/{id}/edit', 'Seguro\SolicitudController@edit');
    Route::get('seguros/ver/{id}', 'Seguro\SolicitudController@show');
    Route::get('seguros/descarga/{id}', 'Seguro\SolicitudController@descarga');
    Route::get('seguros/solicitar/info/{id}', 'Seguro\SolicitudController@info');
    Route::get('seguros/solicitar/terminos/{id}', 'Seguro\SolicitudController@terminos');
    Route::get('seguros/solicitar/add/{id}', 'Seguro\SolicitudController@create');
    Route::put('seguros/solicitar/{id}', 'Seguro\SolicitudController@update');
    Route::delete('solicitar/{id}', 'Seguro\SolicitudController@destroy');
});

////ADMINISTRADOR

Route::group(['middleware' => 'adminuser'], function () {
    //Inicio
    Route::get('admin_home', 'AdminHomeController@index');
    Route::get('admin_perfil', 'Admin\AdminController@index');
    Route::get('datos_admin/{id}', 'Admin\AdminController@ver');
    Route::get('admin/{id}', 'Admin\Users_detalleController@datos');
    Route::get('admin_help', 'Admin\AdminController@help');

    Route::group(['middleware' => 'coordinador'], function () {
        Route::get('admin_evento', 'Evento\EventoController@indexadmin');
        Route::get('admin_evento/add', 'Evento\EventoController@create');
        Route::post('admin_evento/add', 'Evento\EventoController@store');
        Route::post('admin_evento/estado/{id}', 'Evento\EventoController@estado');
        Route::get('admin_evento/ver/{id}/edit', 'Evento\EventoController@edit');
        Route::put('admin_evento/{id}', 'Evento\EventoController@update');

        Route::get('admin_servicios/clasificados', 'Servicio\ClasificadoController@indexadmin');
        Route::get('admin_servicios/clasificados/ver/{id}', 'Servicio\ClasificadoController@show');
        Route::get('admin_servicios/clasificados/ver/{id}/edit', 'Servicio\ClasificadoController@edit');
        Route::put('admin_servicios/clasificados/{id}', 'Servicio\ClasificadoController@update');
        Route::get('admin_servicios/pqrs', 'Servicio\PqrsController@create');
        Route::get('admin_servicios/pqrs/ver/{id}', 'Servicio\PqrsController@show');
        Route::get('admin_servicios/pqrs/descarga/{id}', 'Servicio\PqrsController@descarga');
        Route::put('admin_servicios/pqrs/{id}', 'Servicio\PqrsController@update');
    });

    Route::group(['namespace' => 'Admin_boleteria'], function () {
        Route::group(['middleware' => 'jefe'], function () {
            Route::get('admin_boleteria/inventario', 'InformeController@inventario');
            Route::get('admin_boleteria/inventario/excel/seriales', 'InformeController@serialesexcel');
            Route::get('admin_boleteria/inventario/excel/ventas', 'InformeController@ventasesexcel');

            Route::get('admin_boleteria/proveedores', 'ProveedorController@index');
            Route::get('admin_boleteria/proveedores/add', 'ProveedorController@create');
            Route::post('admin_boleteria/proveedores/add/linea', 'ProveedorController@linea');
            Route::post('admin_boleteria/proveedores/add', 'ProveedorController@store');
            Route::get('admin_boleteria/proveedores/ver/{id}', 'ProveedorController@show');
            Route::delete('admin_boleteria/proveedores/{id}', 'ProveedorController@destroy');
            Route::put('admin_boleteria/proveedores/{id}', 'ProveedorController@update');
            Route::get('admin_boleteria/proveedores/ver/{id}/edit', 'ProveedorController@edit');
            Route::get('admin_boleteria/proveedores/actualizar', 'ProveedorController@actualizar');

            Route::get('admin_boleteria/productos', 'ProductosController@index');
            Route::get('admin_boleteria/productos/add', 'ProductosController@create');
            Route::post('admin_boleteria/productos/add', 'ProductosController@store');
            Route::get('admin_boleteria/productos/ver/{id}', 'ProductosController@show');
            Route::put('admin_boleteria/productos/{id}', 'ProductosController@update');
            Route::get('admin_boleteria/productos/ver/{id}/edit', 'ProductosController@edit');

            Route::get('admin_boleteria/seriales', 'SerialController@index');
            Route::get('admin_boleteria/seriales/add/', 'SerialController@create');
            Route::post('admin_boleteria/seriales/add/cant', 'SerialController@store');
            Route::post('admin_boleteria/seriales/add/no', 'SerialController@storeNo');
            Route::get('admin_boleteria/seriales/ver/{id}', 'SerialController@show');
            Route::put('admin_boleteria/seriales/{id}', 'SerialController@update');
            Route::get('admin_boleteria/seriales/ver/{id}/edit', 'SerialController@edit');

            Route::get('admin_boleteria/asignacion', 'AsignarController@index');
            Route::get('admin_boleteria/asignacion/add', 'AsignarController@create');
            Route::post('admin_boleteria/asignacion/add', 'AsignarController@store');
            Route::get('admin_boleteria/asignacion/ver/{id}', 'AsignarController@show');
            Route::get('admin_boleteria/asignacion/ver/{id}/edit', 'AsignarController@edit');

            Route::get('admin_boleteria/coordinador/ver/{id}', 'CoordinadorController@coordinadorshow');

        });
        Route::group(['middleware' => 'coordinador'], function () {
            Route::get('admin_boleteria/coordinador', 'CoordinadorController@index');
            Route::put('admin_boleteria/coordinador/aprobar/{id}', 'CoordinadorController@aprobar');
            Route::put('admin_boleteria/coordinador/negar/{id}', 'CoordinadorController@negar');

            Route::get('admin_boleteria/vender', 'VenderController@index');
            Route::get('admin_boleteria/vender/add', 'VenderController@create');
            Route::post('admin_boleteria/vender/add', 'VenderController@store');
            Route::get('admin_boleteria/vender/ver/{id}', 'VenderController@show');
            Route::get('admin_boleteria/vender/ver/pdf/{id}', 'VenderController@pdfadmin');
        });
        Route::get('admin_boleteria', 'InformeController@index');
        Route::post('admin_boleteria/buscar/cedula', 'InformeController@cedula');
        Route::post('admin_boleteria/buscar/referencia', 'InformeController@referencia');
        Route::post('admin_boleteria/buscar/serial', 'InformeController@serial');
    });

    Route::group(['middleware' => 'subgerente'], function () {
      Route::resource('admin_config/user', 'Admin\ConfigUserController',['except' => ['destroy']]);
      Route::resource('admin_config/permisos', 'Admin\ConfigPermisosController',['except' => ['destroy']]);
      Route::resource('admin_config/area', 'Admin\ConfigAreasController',['except' => ['destroy']]);
      Route::resource('admin_config/area_item', 'Admin\ConfigAreasItemsController',['except' => ['destroy']]);
      Route::resource('admin_config/area_admin', 'Admin\ConfigAreasAdminController',['except' => ['destroy']]);
      Route::resource('admin_config/areas_admin_items', 'Admin\ConfigAreasAdminItemController',['except' => ['destroy']]);
      Route::resource('admin_config/menu_user', 'Admin\ConfigMenuController',['except' => ['destroy']]);
      Route::resource('admin_config/menu_user_sub', 'Admin\ConfigSubMenuController',['except' => ['destroy']]);
      Route::resource('admin_config/menu_admin', 'Admin\ConfigMenuAdminController',['except' => ['destroy']]);
      Route::resource('admin_config/menu_admin_sub', 'Admin\ConfigSubMenuAdminController',['except' => ['destroy']]);


    });
});

//login admin
Route::get('admin_login', 'AdminAuth\LoginController@showLoginForm');
Route::post('admin_login', 'AdminAuth\LoginController@login');
Route::post('admin_logout', 'AdminAuth\LoginController@logout');
Route::post('admin_password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail');
Route::get('admin_password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm');
Route::post('admin_password/reset', 'AdminAuth\ResetPasswordController@reset');
Route::get('admin_password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');
Route::get('admin_register', 'AdminAuth\RegisterController@showRegistrationForm');
Route::post('admin_register', 'AdminAuth\RegisterController@register');
Route::get('auth/{provider}', 'Auth\RegisterController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\RegisterController@handleProviderCallback');

///Sin login
Route::group(['namespace' => 'Usuario'], function () {
    Route::get('simulador', 'SimuladorController@index');
    Route::post('simulador/add', 'SimuladorController@store');
    Route::post('simulador/pdf', 'SimuladorController@invoice');
});
Route::get('clasificados', 'Servicio\ClasificadoController@index');
Route::get('cumple', 'Servicio\ServicioController@cumple');
