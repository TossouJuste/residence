<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('/login'); // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
        }

        if (!$request->user()->hasRole($role)) {
            abort(403, 'Accès interdit'); // Affiche une erreur 403 si l'utilisateur n'a pas le rôle
        }

        return $next($request);
    }
}
