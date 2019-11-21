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

        //Route::get('solicitud/productos', 'SolicitudProducto\SolicitudController@index');
        Route::get('solicitud/productos')->uses('SolicitudProducto\SolicitudController@index')->name('solicitud.index');

       // Route::get('solicitud/solicitar', 'SolicitudProducto\SolicitudController@create');
        Route::get('solicitud/solicitar')->uses('SolicitudProducto\SolicitudController@create')->name('solicitud.create');

       // Route::post('solicitud/solicitar', 'SolicitudProducto\SolicitudController@store');
         Route::post('solicitud/solicitar')->uses('SolicitudProducto\SolicitudController@store')->name('solicitud.store');

        Route::post('solicitud/productos/codigo/{id}', 'SolicitudProducto\SolicitudController@codigo');
        Route::get('solicitud/comprobante/{id}', 'SolicitudProducto\SolicitudController@show');

        //Rutas polla mundial
        Route::get('predictions/create')->uses('Usuario\PollaController@create')->name('predictions.create');
        Route::post('predictions/store')->uses('Usuario\PollaController@store')->name('predictions.store');
        Route::get('predictions/{polla}')->uses('Usuario\PollaController@show')->name('predictions.show');
        

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
    Route::get('admin/{id}', 'Usuario\Users_detalleController@datos');
    Route::get('admin_help', 'Admin\AdminController@help');
    Route::post('admin_help', 'Admin\AdminController@help');
    Route::get('datos_usuario/{id}', 'Usuario\Users_detalleController@datosUsuario');
    Route::get('solicitud/comprobante-adm/{id}', 'SolicitudProducto\SolicitudController@show');

    /** jpiedrahita */
    Route::get('predictions')->uses('Usuario\PollaController@index')->name('predictions.index');
    Route::get('excel','Usuario\PollaController@polla');

    Route::group(['middleware' => 'proveedor'], function () {
        /**
         * Aca se crean las rutas correspondientes al manejo de las lineas
         * de los proveedores y se complemetan con las vistas
         */
    });

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

        Route::get('solicitudes/solicitados', 'SolicitudProducto\SolicitudController@solicitudes');
        Route::get('solicitudes/productos', 'SolicitudProducto\ProductoController@index');


        Route::get('solicitudes/productos/add', 'SolicitudProducto\ProductoController@create');
        Route::get('solicitudes/productos/{id}/edit', 'SolicitudProducto\ProductoController@edit');
        Route::post('solicitudes/productos/update/{id}', 'SolicitudProducto\ProductoController@update');
        Route::get('solicitudes/productos/actualizar', 'SolicitudProducto\ProductoController@actualizar');

        Route::post('solicitudes/productos/activar/{id}', 'SolicitudProducto\ProductoController@activar');
        Route::post('solicitudes/productos/add')->uses('SolicitudProducto\ProductoController@store')->name('productos.store');


        Route::post('solicitudes/solicitados/aprobar', 'SolicitudProducto\SolicitudController@aprobar');
        Route::get('solicitudes/solicitados-excel', 'SolicitudProducto\SolicitudController@excel');
        Route::post('solicitudes/solicitados-excelEstado/{id}', 'SolicitudProducto\SolicitudController@excelEstados');
        Route::post('solicitudes/solicitados-excelEstadoOtro', 'SolicitudProducto\SolicitudController@excelEstadosOtro');
        Route::get('solicitudes/solicitados-descarga/{archivo}', 'SolicitudProducto\SolicitudController@descarga');
        /*jpiedrahita*/
        Route::get('solicitudes/file')->uses('SolicitudProducto\SolicitudController@file')->name('solicitudes.file');
        Route::get('solicitudes/file-servicios')->uses('SolicitudProducto\SolicitudController@servicio')->name('solicitudes.file-servicios');
        Route::get('solicitudes/file-productos')->uses('SolicitudProducto\SolicitudController@producto')->name('solicitudes.file-productos');

        Route::get('solicitudes/solicitados/{id}', 'SolicitudProducto\SolicitudController@solicitudesShow');
        Route::get('solicitudes/solicitados/ver/{id}', 'SolicitudProducto\SolicitudController@edit');
        Route::post('solicitudes/solicitados/ver/{id}', 'SolicitudProducto\SolicitudController@update');
        Route::get('solicitudes/desembolso', 'SolicitudProducto\SolicitudController@desembolso');

        Route::get('solicitudes/desembolso/{id}', 'SolicitudProducto\SolicitudController@desembolsar');

        Route::post('solicitudes/desembolso/{id}', 'SolicitudProducto\SolicitudController@udpateDesembolsar');


    });



    Route::group(['namespace' => 'Admin_boleteria'], function () {
        Route::group(['middleware' => 'jefe'], function () {
            Route::get('admin_boleteria/inventario', 'InformeController@inventario');
            Route::get('admin_boleteria/inventario/excel/seriales', 'InformeController@serialesexcel');
            Route::get('admin_boleteria/inventario/excel/ventas', 'InformeController@ventasesexcel');

            /*jpiedrahita*/
            Route::get('admin_boleteria/inventario/tenencia', 'InformeController@tenenciaexcel');

            Route::get('admin_boleteria/proveedores', 'ProveedorController@index');
            Route::get('admin_boleteria/proveedores/add', 'ProveedorController@create');
            Route::post('admin_boleteria/proveedores/add/linea', 'ProveedorController@linea');
            Route::post('admin_boleteria/proveedores/add', 'ProveedorController@store');
            Route::get('admin_boleteria/proveedores/ver/{id}', 'ProveedorController@show');
            Route::delete('admin_boleteria/proveedores/{id}', 'ProveedorController@destroy');
            Route::put('admin_boleteria/proveedores/{id}', 'ProveedorController@update');
            Route::get('admin_boleteria/proveedores/ver/{id}/edit', 'ProveedorController@edit');
            Route::get('admin_boleteria/proveedores/actualizar', 'ProveedorController@actualizar');
            Route::get('admin_boleteria/proveedores/ver/{id}/nit/{nit}', 'ProveedorController@nit');

            Route::get('admin_boleteria/productos', 'ProductosController@index');
            Route::get('admin_boleteria/productos/add', 'ProductosController@create');
            Route::post('admin_boleteria/productos/add', 'ProductosController@store');
            Route::get('admin_boleteria/productos/ver/{id}', 'ProductosController@show');
            Route::put('admin_boleteria/productos/{id}', 'ProductosController@update');
            Route::get('admin_boleteria/productos/ver/{id}/edit', 'ProductosController@edit');

            //Route::get('admin_boleteria/seriales', 'SerialController@index');
            Route::get('admin_boleteria/seriales')->uses('SerialController@index')->name('admin_boleteria.seriales');

            Route::get('admin_boleteria/seriales/add/', 'SerialController@create');
            Route::post('admin_boleteria/seriales/add/cant', 'SerialController@store');
            Route::post('admin_boleteria/seriales/add/no', 'SerialController@storeNo');
            Route::get('admin_boleteria/seriales/ver/{id}', 'SerialController@show');
            Route::put('admin_boleteria/seriales/{id}', 'SerialController@update');
            Route::get('admin_boleteria/seriales/ver/{id}/edit', 'SerialController@edit');

            //Route::get('admin_boleteria/asignacion', 'AsignarController@index');

            Route::get('admin_boleteria/asignacion')->uses('AsignarController@index')->name('admin_boleteria.asignacion');

            Route::get('admin_boleteria/asignacion/add/{id}', 'AsignarController@create');
            Route::post('admin_boleteria/asignacion/add', 'AsignarController@store');
            Route::get('admin_boleteria/asignacion/ver/{id}', 'AsignarController@show');
            Route::get('admin_boleteria/asignacion/ver/{id}/edit', 'AsignarController@edit');

            Route::get('admin_boleteria/coordinador/ver/{id}', 'CoordinadorController@coordinadorshow');

        });
        Route::group(['middleware' => 'coordinador'], function () {
            Route::get('admin_boleteria/coordinador', 'CoordinadorController@index');
            //Route::put('admin_boleteria/coordinador/aprobar/{id}', 'CoordinadorController@aprobar');
            Route::put('admin_boleteria/coordinador/aprobar/', 'CoordinadorController@aprobar');
            Route::get('admin_boleteria/coordinador/aprobarTodos/', 'CoordinadorController@aprobarTodos');
            Route::put('admin_boleteria/coordinador/negar/{id}', 'CoordinadorController@negar');

            Route::get('admin_boleteria/vender', 'VenderController@index');
            //Route::get('admin_boleteria/vender/add', 'VenderController@create');
            Route::get('admin_boleteria/vender/add', 'VenderController@vender');
            Route::get('admin_boleteria/vender/add/{id}', 'VenderController@venderProducto');
            //Route::post('admin_boleteria/vender/add', 'VenderController@store');
            Route::get('admin_boleteria/vender/add/asociado/{cedula}', 'VenderController@asociadoCedula');
            Route::post('admin_boleteria/vender/servicio/{id}', 'VenderController@servicio');
            Route::post('admin_boleteria/vender/credito/{id}', 'VenderController@credito');
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



//Acces to Web Service Controller
Route::post('ws/consumo', 'WebServiceController@guardarConsumo');
Route::post('ws/cupo', 'WebServiceController@obtenerCupoWebService');
Route::post('ws/compras', 'WebServiceController@obtenerComprasWebService');
Route::post('ws/login', 'WebServiceController@login_service');
Route::get('ws/json', 'WebServiceController@getdatajson');
