<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class UserMiddleware
{

    /**
    * The Guard implementation.
    *
    * @var Guard
    */
    protected $auth;

    /**
    * Create a new filter instance.
    *
    * @param  Guard  $auth
    * @return void
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
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->route('ShowLogin');
            }
        } else {
            if ($this->auth->with("user")) {
                if (!$this->auth->user()->hasRole(['candidate','admin','su','moderator'])) {
                    if ($request->ajax()) {
                        return response('Unauthorized.', 401);
                    } else {
                        return redirect()->route('Home');
                    }
                }
            }
        }

        return $next($request);
    }
}
