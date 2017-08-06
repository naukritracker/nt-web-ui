<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\VerifyCsrfToken::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.notloggedin' => \App\Http\Middleware\NotLoggedInMiddleware::class,
        'auth.loggedin' => \App\Http\Middleware\LoggedInMiddleware::class,
        'auth.user' => \App\Http\Middleware\UserMiddleware::class,
        'auth.employer' => \App\Http\Middleware\EmployerMiddleware::class,
        'guest.employer' => \App\Http\Middleware\EmployerGuestMiddleware::class,
        'auth.admin' => \App\Http\Middleware\AdminMiddleware::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'role' => Zizaco\Entrust\Middleware\EntrustRole::class,
        'permission' => Zizaco\Entrust\Middleware\EntrustPermission::class,
        'ability' => Zizaco\Entrust\Middleware\EntrustAbility::class,
    ];
}
