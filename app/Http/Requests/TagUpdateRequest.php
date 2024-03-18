<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        return [
            'tag_name' => 'required|max:20',
            'tag_sort_order' => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attributeは必須です。',
            'max' => ":attributeは:max文字以内で入力して下さい。",
            'min' => ":attributeは:min以上で入力して下さい。",
            'integer' => ':attributeは数値(整数)で入力して下さい。',
        ];
    }

    public function attributes()
    {
        return [
            'tag_name' => 'タグ名',
            'tag_sort_order' => 'タグ並び順',
        ];
    }
}
