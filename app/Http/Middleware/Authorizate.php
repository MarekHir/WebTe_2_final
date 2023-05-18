<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authorizate extends Authorize
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     * @throws AuthorizationException
     */
    public function handle($request, Closure $next, $ability, ...$models)
    {
        if($this->gate->check($ability, $this->getGateArguments($request, $models))){
            return $next($request);
        }


        return response()->json([
            'message' => trans('validation.notAutorized'),
        ], Response::HTTP_FORBIDDEN);
    }
}
