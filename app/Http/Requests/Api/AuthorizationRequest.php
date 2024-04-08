<?php
/***
 * Author: CHEN Ray
 * Email: chenraygogo@gmail.com
 * Create_at: 2024/4/1 0:21
 **/

namespace App\Http\Requests\Api;


class AuthorizationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => 'required|string',
            'password' => 'required|alpha_dash|min:6',
        ];
    }
}
