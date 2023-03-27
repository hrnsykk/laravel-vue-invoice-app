<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthLoginRequest;
use App\Http\Requests\Auth\AuthRegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

        if (Auth::attempt($request->all())) {
            $user = $request->user();
            $success["token"] = $user->createToken("Invoice-App")->plainTextToken;
            $success["name"] = $user->name;

            $response = [
                "success" => true,
                "data" => $success,
                "message" => "User Register Successfully"
            ];

            return response()->json($response, 200);
        } else {
            $response = [
                "success" => false,
                "message" => "Unauthorised"
            ];

            return response()->json($response, 200);
        }
    }
}
