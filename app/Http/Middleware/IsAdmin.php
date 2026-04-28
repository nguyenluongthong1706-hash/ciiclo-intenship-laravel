<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if(!$user || $user->role !== "ADMIN"){
             return response()->json([
                'message' => 'Bạn không có quyền truy cập (Admin only)'
            ], 403);
        }
        return $next($request);
    }
}
