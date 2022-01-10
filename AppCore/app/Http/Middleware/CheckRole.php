<?php

namespace App\Http\Middleware;
use Closure;
// use Illuminate\Auth\Middleware\Authenticate as Middleware;

class CheckRole
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('admin.showLoginFormAdmin');
        }       
    }

    public function handle($request, Closure $next, $role)
    {
        // $this->authenticate($request, $guards);
        if (!auth()->check()) {
            $this->redirectTo($request);
        }

        if (auth()->check() && ( auth()->user()->is_superadmin || auth()->user()->has_role($role) )){
            return $next($request);
        }

        return redirect()->back()->with('errors', 'No puede acceder a la sección ya que no posee los permisos necesario');
    }
}