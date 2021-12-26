<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class UserController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public final function index(Request $request): JsonResponse
    {
        if($request->user->profile !== 'admin'){
            return response()->json(['error'=>'unauthorized'], 403);
        }

        $users = User::all();
        return response()->json([
            'userRequest' => $request->user(),
            'userList'=>$users
        ]);
    }
}
