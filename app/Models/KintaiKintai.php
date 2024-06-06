<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// その他
use Illuminate\Support\Facades\DB;
use Carbon\CarbonImmutable;

class KintaiKintai extends Model
{
    use HasFactory;
    // 接続するDBをセット
    protected $connection = 'kintai';
    // 接続するテーブルをセット
    protected $table = 'kintais';

    // 現在の営業所毎の出勤人数を取得
    public static function getCurrentWorkingEmployeesCountByBase()
    {
        return self::where('work_day', CarbonImmutable::now()->format('Y-m-d'))
                ->whereNull('finish_time')
                ->join('employees', 'employees.employee_id', 'kintais.employee_id')
                ->join('employee_categories', 'employee_categories.employee_category_id', 'employees.employee_category_id')
                ->join('bases', 'bases.base_id', 'employees.base_id')
                ->select('bases.base_id', 'shortened_base_name', 'employee_categories.employee_category_name', DB::raw('count(*) as working_count'))
                ->groupBy('bases.base_id', 'employee_categories.employee_category_id')
                ->orderBy('bases.base_id', 'asc')
                ->get();
    }
}
