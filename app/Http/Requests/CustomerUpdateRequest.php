<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdateRequest extends FormRequest
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
            'customer_category' => 'required|max:20',
            'customer_name' => 'required|max:20',
            'base_id' => 'required|exists:bases,base_id',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attributeは必須です。',
            'max' => ":attributeは:max文字以内で入力して下さい。",
            'exists' => ':attributeが存在しません。',
        ];
    }

    public function attributes()
    {
        return [
            'customer_category' => '荷主分類',
            'customer_name' => '荷主名',
            'base_id' => '拠点名',
        ];
    }
}
