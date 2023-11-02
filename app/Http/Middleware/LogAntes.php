<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class LogAntes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Log::info('Antes de acceder.');
        return $next($request);
    }

    public function terminate($request,$response) 
    {
        $users = DB::table('users')->get();
        $usuarios = [];
        foreach ($users as $user) {
            $usuarios[] = $user->name;
        }

        Log::info('Mensaje cargado despues! Usuarios en la DB: ' . implode(', ', $usuarios));
        Log::info('Despues de acceder');
    }
}
