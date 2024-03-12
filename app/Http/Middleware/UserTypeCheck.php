<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserTypeCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $usertype): Response
    {
        $userRole = $request->user()->role;
        if($userRole === 'user' &&  $usertype !== 'user'){
            return redirect('dashboard');
        } elseif ($userRole === 'admin' &&  $usertype !== 'admin'){
            return redirect('/admin/dashboard');
        } elseif ($userRole === 'instructor' &&  $usertype !== 'instructor'){
            return redirect('/instructor/dashboard');
        }
        return $next($request);
    }
}
