<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class TimeFormatRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // 時刻の正規表現パターン (HH:MM) または (HH:MM:SS)
        $pattern = '/^(?:[01]\d|2[0-3]):(?:[0-5]\d)(?::(?:[0-5]\d))?$/';
        // 正規表現で時刻形式をチェック
        if (!preg_match($pattern, $value)) {
            $fail('アラート発報時刻が正しくありません。');
        }
    }
}
