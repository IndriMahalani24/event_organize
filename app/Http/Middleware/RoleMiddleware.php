<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $roles
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, $roles): Response
    {
        // Jika belum login, redirect ke login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Ambil role ID user yang sedang login (dari relasi 'role')
        $userRoleId = Auth::user()->role->id ?? null;

        // Ubah parameter roles jadi array, support format: role:1,2,3
        $allowedRoles = explode(',', $roles);

        // Jika user tidak memiliki salah satu dari role yang diizinkan, abort
        if (!in_array($userRoleId, $allowedRoles)) {
            abort(403, 'Unauthorized');
        }

        // Lanjut ke request berikutnya
        return $next($request);
    }
}
