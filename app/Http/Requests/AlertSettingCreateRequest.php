<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
// ルール
use App\Rules\TimeFormatRule;

class AlertSettingCreateRequest extends FormRequest
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
            'alert_setting_name' => 'required|max:20',
            'customer_code' => 'required|max:20|exists:customers,customer_code',
            'item_code' => 'required|max:50|exists:items,item_code',
            'alert_time' => ['required', new TimeFormatRule],
            'alert_value' => 'required|integer|min:1',
            'alert_message' => 'required|max:20',
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
        ];
    }

    public function attributes()
    {
        return [
            'alert_setting_name' => '設定名',
            'customer_code' => '荷主名',
            'item_code' => '項目名',
            'alert_time' => 'アラート発報時刻',
            'alert_value' => 'アラート発報値',
            'alert_message' => 'アラートメッセージ',
        ];
    }
}
