<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use App\Helpers\PocJwt;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public static function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('email', 'password')))
        {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail(['id','name','profile']);

        $payload = [
            'id' => $user->id,
            'name' => $user->name,
            'profile' => $user->profile
        ];

        $user->token = PocJwt::createToken($payload);
        $user->save();

        return response()->json(['token' => $user->token]);
    }

    public static function logout(Request $request){

    }
}
