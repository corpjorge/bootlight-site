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
        Route::group(['middleware' => 'gerente'], function () {
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
        Route::get('admin_config/user', 'Admin\ConfigUserController@index');
        Route::get('admin_config/user/add', 'Admin\ConfigUserController@create');
        Route::post('admin_config/user/add', 'Admin\ConfigUserController@store');
        Route::get('admin_config/user/ver/{id}', 'Admin\ConfigUserController@show');
        Route::get('admin_config/user/ver/{id}/edit', 'Admin\ConfigUserController@edit');
        Route::put('admin_config/user/{id}', 'Admin\ConfigUserController@update');

        Route::get('admin_config/permisos', 'Admin\ConfigPermisosController@index');
        Route::get('admin_config/permisos/add', 'Admin\ConfigPermisosController@create');
        Route::post('admin_config/permisos/add', 'Admin\ConfigPermisosController@store');
        Route::get('admin_config/permisos/ver/{id}', 'Admin\ConfigPermisosController@show');
        Route::get('admin_config/permisos/ver/{id}/edit', 'Admin\ConfigPermisosController@edit');
        Route::put('admin_config/permisos/{id}', 'Admin\ConfigPermisosController@update');

        Route::get('admin_config/areas', 'Admin\ConfigAreasController@index');
        Route::get('admin_config/areas/add', 'Admin\ConfigAreasController@create');
        Route::post('admin_config/areas/add', 'Admin\ConfigAreasController@store');
        Route::get('admin_config/areas/ver/{id}', 'Admin\ConfigAreasController@show');
        Route::get('admin_config/areas/ver/{id}/edit', 'Admin\ConfigAreasController@edit');
        Route::put('admin_config/areas/{id}', 'Admin\ConfigAreasController@update');

        Route::get('admin_config/areas_items', 'Admin\ConfigAreasItemsController@index');
        Route::get('admin_config/areas_items/add', 'Admin\ConfigAreasItemsController@create');
        Route::post('admin_config/areas_items/add', 'Admin\ConfigAreasItemsController@store');
        Route::get('admin_config/areas_items/ver/{id}', 'Admin\ConfigAreasItemsController@show');
        Route::get('admin_config/areas_items/ver/{id}/edit', 'Admin\ConfigAreasItemsController@edit');
        Route::put('admin_config/areas_items/{id}', 'Admin\ConfigAreasItemsController@update');

        Route::get('admin_config/areas_admin', 'Admin\ConfigAreasAdminController@index');
        Route::get('admin_config/areas_admin/add', 'Admin\ConfigAreasAdminController@create');
        Route::post('admin_config/areas_admin/add', 'Admin\ConfigAreasAdminController@store');
        Route::get('admin_config/areas_admin/ver/{id}', 'Admin\ConfigAreasAdminController@show');
        Route::get('admin_config/areas_admin/ver/{id}/edit', 'Admin\ConfigAreasAdminController@edit');
        Route::put('admin_config/areas_admin/{id}', 'Admin\ConfigAreasAdminController@update');

        Route::get('admin_config/areas_admin_items', 'Admin\ConfigAreasAdminItemController@index');
        Route::get('admin_config/areas_admin_items/add', 'Admin\ConfigAreasAdminItemController@create');
        Route::post('admin_config/areas_admin_items/add', 'Admin\ConfigAreasAdminItemController@store');
        Route::get('admin_config/areas_admin_items/ver/{id}', 'Admin\ConfigAreasAdminItemController@show');
        Route::get('admin_config/areas_admin_items/ver/{id}/edit', 'Admin\ConfigAreasAdminItemController@edit');
        Route::put('admin_config/areas_admin_items/{id}', 'Admin\ConfigAreasAdminItemController@update');

        Route::get('admin_config/menu', 'Admin\ConfigMenuController@index');
        Route::get('admin_config/menu/add', 'Admin\ConfigMenuController@create');
        Route::post('admin_config/menu/add', 'Admin\ConfigMenuController@store');
        Route::get('admin_config/menu/ver/{id}', 'Admin\ConfigMenuController@show');
        Route::get('admin_config/menu/ver/{id}/edit', 'Admin\ConfigMenuController@edit');
        Route::put('admin_config/menu/{id}', 'Admin\ConfigMenuController@update');

        Route::get('admin_config/sub_menu', 'Admin\ConfigSubMenuController@index');
        Route::get('admin_config/sub_menu/add', 'Admin\ConfigSubMenuController@create');
        Route::post('admin_config/sub_menu/add', 'Admin\ConfigSubMenuController@store');
        Route::get('admin_config/sub_menu/ver/{id}', 'Admin\ConfigSubMenuController@show');
        Route::get('admin_config/sub_menu/ver/{id}/edit', 'Admin\ConfigSubMenuController@edit');
        Route::put('admin_config/sub_menu/{id}', 'Admin\ConfigSubMenuController@update');

        Route::get('admin_config/menu_admin', 'Admin\ConfigMenuAdminController@index');
        Route::get('admin_config/menu_admin/add', 'Admin\ConfigMenuAdminController@create');
        Route::post('admin_config/menu_admin/add', 'Admin\ConfigMenuAdminController@store');
        Route::get('admin_config/menu_admin/ver/{id}', 'Admin\ConfigMenuAdminController@show');
        Route::get('admin_config/menu_admin/ver/{id}/edit', 'Admin\ConfigMenuAdminController@edit');
        Route::put('admin_config/menu_admin/{id}', 'Admin\ConfigMenuAdminController@update');

        Route::get('admin_config/sub_menu_admin', 'Admin\ConfigSubMenuAdminController@index');
        Route::get('admin_config/sub_menu_admin/add', 'Admin\ConfigSubMenuAdminController@create');
        Route::post('admin_config/sub_menu_admin/add', 'Admin\ConfigSubMenuAdminController@store');
        Route::get('admin_config/sub_menu_admin/ver/{id}', 'Admin\ConfigSubMenuAdminController@show');
        Route::get('admin_config/sub_menu_admin/ver/{id}/edit', 'Admin\ConfigSubMenuAdminController@edit');
        Route::put('admin_config/sub_menu_admin/{id}', 'Admin\ConfigSubMenuAdminController@update');
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
