<?php

namespace App\Http\Requests;

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'content' => 'required|max:20',
            'tag_id' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'content.required' => 'タスクを入力してください',
            'content.max' => '２０文字以内で入力してください',
        ];
    }
}
