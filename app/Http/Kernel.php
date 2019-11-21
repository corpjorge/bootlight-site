<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'adminuser' => \App\Http\Middleware\DeniedIfNotAdmin::class,
        'adminauth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'gerente' => \App\Http\Middleware\Gerente::class,
        'subgerente' => \App\Http\Middleware\Subgerente::class,
        'director' => \App\Http\Middleware\Director::class,
        'jefe' => \App\Http\Middleware\Jefe::class,
        'coordinador' => \App\Http\Middleware\Coordinador::class,
        'auxiliar' => \App\Http\Middleware\Auxiliar::class,
        'asistente' => \App\Http\Middleware\Asistente::class,
        'asociado' => \App\Http\Middleware\Asociado::class,
        'colaborador' => \App\Http\Middleware\Colaborador::class,
        'publico' => \App\Http\Middleware\Publico::class,
        'ws' => \App\Http\Middleware\WebServices::class,
        'jwt.auth' => 'Tymon\JWTAuth\Middleware\GetUserFromToken',
        'jwt.refresh' => 'Tymon\JWTAuth\Middleware\RefreshToken',

        /**
         * Este middleware controla el acceso de los proveedores al sistema,
         * en el archivo routes\web.php se configura la linea a la cual puede acceder el proveedor
         * y se complementa en la vista correspondiente
         */
        'proveedor' => \App\Http\Middleware\Publico::class,

    ];
}
