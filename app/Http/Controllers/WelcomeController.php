<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\AbnormalLog;

class WelcomeController extends Controller
{
    public function index()
    {
        // 異常ログを取得
        $abnormal_logs = AbnormalLog::all();
        return view('welcome')->with([
            'abnormal_logs' => $abnormal_logs,
        ]);
    }
}
