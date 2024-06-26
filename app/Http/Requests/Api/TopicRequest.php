<?php

namespace App\Http\Requests\Api;

class TopicRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        switch($this->method()) {
            case 'POST':
                return [
                    'title' => 'required|string',
                    'body' => 'required|string',
                    'category_id' => 'required|exists:categories,id',
                ];
                break;
            case 'PATCH':
                return [
                    'title' => 'required|string',
                    'body' => 'string',
                    'category_id' => 'exists:categories,id',
                ];
                break;
        }
    }

    public function attributes(): array
    {
        return [
            'title' => 'title',
            'body' => 'body',
            'category_id' => 'category id',
        ];
    }
}
