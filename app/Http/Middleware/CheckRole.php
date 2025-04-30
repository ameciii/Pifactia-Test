<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        $user = $request->user();

        // Cek: kalau belum login atau role_id-nya kosong atau role relasinya null
        if (!$user || !$user->role || $user->role->name !== $role) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
