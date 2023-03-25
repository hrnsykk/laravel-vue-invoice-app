<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthLoginRequest;
use App\Http\Requests\Auth\AuthRegisterRequest;
use App\Models\User;

class AuthController extends Controller
{
    public function register(AuthRegisterRequest $request)
    {
        $input = $request->all();
        $input["password"] = bcrypt($input['password']);
        $user = User::create($input);
        return response()->json($user, 200);
    }

    public function login(AuthLoginRequest $request)
    {
        return response()->json($request->all(), 200);
    }
}
