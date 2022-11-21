<?php

namespace App\Http\Requests;

use Dotenv\Store\File\Paths;
use Illuminate\Foundation\Http\FormRequest;

class TodoRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:20'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'タスクを入力して下さい。',
            'title.max' => '20文字以内で入力して下さい。'
        ];
    }
}
