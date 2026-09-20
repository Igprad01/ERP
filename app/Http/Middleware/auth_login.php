<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class auth_login
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!Auth::check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda belum login. Silakan login terlebih dahulu.',
            ], 401);
        }

        $auth_user = auth()->user();

        $roleName = $auth_user->role->name ?? $auth_user->role->nama_role ?? '';

        if (!empty($roles) && !in_array($roleName, $roles)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda tidak memiliki akses ke halaman ini.',
            ], 403);
        }

        return $next($request);
    }
}
