<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MatriculeVerified
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('matricule_verifie')) {
            return redirect()->route('verification_matricule.form')->with('error', 'Vous devez vérifier votre matricule pour accéder à cette page.');
        }

        return $next($request);
    }
}
