<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleCreateUpdateRequest extends FormRequest
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
            'role_name' => 'required|max:20',
            'master_operation_is_available' => 'required|in:0,1',
            'management_operation_is_available' => 'required|in:0,1',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attributeは必須です。',
            'max' => ":attributeは:max文字以内で入力して下さい。",
            'in' => ':attributeが正しくありません。',
        ];
    }

    public function attributes()
    {
        return [
            'role_name' => '権限名',
            'master_operation_is_available' => 'マスタ操作',
            'management_operation_is_available' => '管理操作',
        ];
    }
}
