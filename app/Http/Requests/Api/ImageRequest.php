<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\ValidationRule;

class ImageRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = [
            'type' => 'required|string|in:avatar,topic',
        ];

        if ($this->type == 'avatar') {
            $rules['image'] = 'required|mimes:jpeg,bmp,png,gif|dimensions:min_width=200,min_height=200';
        } else {
            $rules['image'] = 'required|mimes:jpeg,bmp,png,gif';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'image.dimensions' => 'The image is not clear enough, the width and height need to be more than 200px',
        ];
    }
}
