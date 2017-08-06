<?php

namespace App\Http\Middleware;

use App\Models\EmployerUser;
use Auth;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class EmployerGuestMiddleware
{
    protected $auth;
    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     *
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check('employer')) {
            return redirect()->route('EmployerProfile');
        }

        return $next($request);
    }
}
