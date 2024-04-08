<?php

namespace App\Http\Requests\Api;


use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        switch($this->method()) {
            case 'POST':
                return [
                    'name'          => 'required|between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name',
                    'password'      => 'required|string|min:6',
                    'captcha_code'  => 'required|string',
                    'captcha_key'   => 'required|string',
                ];
                break;
            case 'PATCH':
                $userId = $this->request->get('id');
                return [
                    'name'  => 'between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name,' .$userId,
                    'email' =>'email|unique:users,email,'.$userId,
                    'introduction'  => 'max:80',
                    //'avatar_image_id' => 'exists:images,id,type,avatar,user_id,'.$userId,
                    'avatar_image_id' =>  Rule::exists('images', 'id')->where(function ($query) use ($userId) {
                        $query->where('type', 'avatar')->where('user_id', $userId);
                    })
                ];
                break;
        }
    }

    public function attributes()
    {
        return [
            'captcha_code' => 'captcha code',
            'captcha_key' => 'captcha key',
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'Username has been occupied, please fill in again',
            'name.regex' => 'Username only supports English, numbers, horizontal bars and underscores.',
            'name.between' => 'Username must be between 3 - 25 characters.',
            'name.required' => 'Username can not be empty.',
        ];
    }
}
