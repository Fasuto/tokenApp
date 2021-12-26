<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Helpers\PocJwt;
use Closure;
use Illuminate\Http\Request;

class VerifyJwt
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $header = $request->header('authorization');
        if(empty($header)){
            return response()->json(['error'=>'authorization token is required'], 401);
        }

        $token = explode(" ", $header)[1];
        if(!PocJwt::verifyToken($token)){
            return response()->json(['error'=>'authorization token is invalid'], 403);
        }

        $user = User::where('token',$token)->first();
        if(empty($user)){
            return response()->json(['error'=>'authorization failed'], 403);
        }

        $request->request->add(['user' => $user]);
        return $next($request);
    }
}
