<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $usuario = User::where('login', $request->login)->first();
        if (
            !$usuario ||
            !Hash::check($request->password, $usuario->password)
        ) {
            return response()->json(
                ['error' => 'Credenciales no válidas'],
                401
            );
        } else {
            $usuario->api_token = Str::random(60);
            $usuario->save();
            return response()->json(['token' => $usuario->api_token]);
        }
    }
}
