<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TeacherRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth('web')->user();

        if ($user === null) {
            return redirect(route('login'));
        }

        if ($user->role !== \App\Models\User::ROLE_TEACHER) {
            return redirect('/');
        }

        return $next($request);
    }
}
