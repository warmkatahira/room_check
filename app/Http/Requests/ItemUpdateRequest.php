<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemUpdateRequest extends FormRequest
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
            'item_name' => 'required|max:20',
            'item_unit' => 'required|max:10',
            'item_sort_order' => 'required|integer|min:1',
            'is_progress_history_add' => 'required|in:0,1',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attributeは必須です。',
            'max' => ":attributeは:max文字以内で入力して下さい。",
            'min' => ":attributeは:min以上で入力して下さい。",
            'integer' => ':attributeは数値(整数)で入力して下さい。',
            'in' => ':attributeが正しくありません。',
        ];
    }

    public function attributes()
    {
        return [
            'item_name' => '項目名',
            'item_unit' => '項目単位',
            'item_sort_order' => '項目並び順',
            'is_progress_history_add' => '進捗履歴追加',
        ];
    }
}
