<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try{
            $user = Auth::user();
            if(!Auth::check() || !$user){
                return abort(401, 'Não autorizado');
            }
        }catch(\Exception $e){
            return response()->json(['message:' => "Token expirado ou não encontrado", 'error' => $e]);
        }
        return $next($request);
    }
}
