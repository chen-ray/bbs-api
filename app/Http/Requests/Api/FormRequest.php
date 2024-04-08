<?php
/***
 * Author: CHEN Ray
 * Email: chenraygogo@gmail.com
 * Create_at: 2024/3/30 15:18
 **/

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;

class FormRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
