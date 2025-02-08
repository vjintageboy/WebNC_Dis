<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        Log::info('RoleMiddleware check', [
            'user' => auth()->user(),
            'required_role' => $role
        ]);

        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();
        
        if (!$user->hasRole($role)) {
            Log::warning('User does not have required role', [
                'user_id' => $user->id,
                'user_role' => $user->role,
                'required_role' => $role
            ]);
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}