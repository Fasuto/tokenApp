<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\PocJwt;

class TokenController extends Controller
{
    public function create(Request $request)
    {
        $payload = [
            'name' => $request->name,
            'role' => 'admin'
        ];

        $response['token'] = PocJwt::createToken($payload);

        return response()->json($response);
    }

    public function verify(Request $request){
        return response()->json(['valid'=>PocJwt::verifyToken($request->token)]);
    }
}
