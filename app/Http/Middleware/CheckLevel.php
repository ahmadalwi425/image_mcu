<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckLevel
{
    public function handle(Request $request, Closure $next, ...$levels): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $userLevel = Auth::user()->id_level;

        if ($userLevel == 1) {
            return $next($request);
        }

        if (!in_array($userLevel, $levels)) {

            if ($userLevel == 2) {
                return redirect()->route('capture');
            } elseif ($userLevel == 3) {
                return redirect()->route('mcu');
            } else {
                return redirect('/dashboard');
            }
        }

        return $next($request);
    }
}