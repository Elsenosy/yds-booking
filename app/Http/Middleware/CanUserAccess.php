<?php

namespace App\Http\Middleware;

use App\Enums\UserTypeEnum;
use App\Traits\HasApiResponse;
use Closure;
use Illuminate\Http\Request;

class CanUserAccess
{
    use HasApiResponse;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $access)
    {
        if (
            !in_array($access, UserTypeEnum::values()) ||
            auth()->user()->user_type != $access
        ){
            return $this->sendError('Unauthorized Access', null, 401);
        }

            return $next($request);
    }
}
