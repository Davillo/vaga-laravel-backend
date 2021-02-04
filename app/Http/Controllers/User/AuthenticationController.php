<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserAuthenticationRequest;
use App\Traits\AuthTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    use AuthTrait;

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserAuthenticationRequest $request)
    {
        $token = auth('api')->attempt(
            ['email' => $request->email, 'password' => $request->password]
        );

        if(!$token){
            return response()->json(['message' => 'Invalid email or password'], Response::HTTP_BAD_REQUEST);
        }

        return response()->json([
            'access_token' => $token,
            'type' => 'bearer'
        ]);
    }
}
