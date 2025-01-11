<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;

class AuthController extends Controller
{
    /**
     * Author : MPT
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $data['token'] = $user->createToken('MyApp')->plainTextToken;
            $data['name'] =  $user->name;
            return response()->json($data, 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }
}
