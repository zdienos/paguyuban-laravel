<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{

    public function handle($request, Closure $next)
    {
        $roles = $this->checkRoute($request->route());
        if($request->user()->hasRole($roles) || !$roles){
            return $next($request);
        }
        return abort(503, "Anda tidak memiliki hak akses");
    }

    private function checkRoute($route)
    {
        $actions = $route->getAction();
        return isset($actions['roles']) ? $actions['roles'] : null;
    }
}
