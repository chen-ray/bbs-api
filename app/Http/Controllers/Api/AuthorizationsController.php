<?php
/***
 * Author: CHEN Ray
 * Email: chenraygogo@gmail.com
 * Create_at: 2024/4/1 0:16
 **/

namespace App\Http\Controllers\Api;


use App\Http\Requests\Api\AuthorizationRequest;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class AuthorizationsController extends Controller
{
    /**
     */
    public function store(AuthorizationRequest $request)
    {
        $username = $request->username;

        filter_var($username, FILTER_VALIDATE_EMAIL) ?
            $credentials['email'] = $username :
            $credentials['name'] = $username;

        $credentials['password'] = $request->password;

        if (!$token = Auth::attempt($credentials)) {
            $this->errorResponse(401, 'The account or password is incorrect', '401');
        }

        return response()->json([
            'access_token' => Auth::user()->createToken('api')->plainTextToken,
            'token_type' => 'Bearer'
        ])->setStatusCode(201);
    }
}
