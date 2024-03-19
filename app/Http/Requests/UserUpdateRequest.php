<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'role_id' => 'required|exists:roles,role_id',
            'status' => 'required|in:0,1',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attributeは必須です。',
            'max' => ":attributeは:max文字以内で入力して下さい。",
            'min' => ":attributeは:min以上で入力して下さい。",
            'integer' => ':attributeは数値(整数)で入力して下さい。',
            'exists' => ':attributeが存在しません。',
            'in' => ':attributeが正しくありません。',
        ];
    }

    public function attributes()
    {
        return [
            'role_id' => '権限',
            'status' => 'ステータス',
        ];
    }
}
