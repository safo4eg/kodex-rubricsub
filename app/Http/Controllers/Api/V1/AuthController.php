<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $attributes = $request->validated();

        User::create([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'password' => Hash::make($attributes['password']),
        ]);

        $oauthAttributes = [
            'grant_type' => 'password',
            'client_id' => $attributes['client_id'],
            'client_secret' => $attributes['client_secret'],
            'username' => $attributes['email'],
            'password' => $attributes['password'],
            'scope' => ''
        ];

        $oauthRequest = Request::create(
            uri: '/oauth/token',
            method: 'POST',
            parameters: $oauthAttributes,
        );

        return app()->handle($oauthRequest);
    }
}
