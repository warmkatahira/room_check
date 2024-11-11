<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\AccessLog;
use App\Models\AbnormalLog;
// その他
use Carbon\CarbonImmutable;
use Rap2hpoutre\FastExcel\FastExcel;

class LogCheckController extends Controller
{
    public function import(Request $request)
    {
        // #######################################################################################
        //                                      ログインポート
        // #######################################################################################
        // 選択したデータのファイル名を取得
        $import_file_name = $request->file('select_file')->getClientOriginalName();
        // 現在の日時を取得
        $nowDate = CarbonImmutable::now();
        // 保存先のストレージ階層を取得
        $spath = storage_path('app/');
        // ファイルを保存して保存先のパスを取得
        $save_file_full_path = $spath.$request->file('select_file')->storeAs('public/import', $import_file_name);
        // 全てのレコードを取得
        $all_line = (new FastExcel)->import($save_file_full_path);
        // テーブルに追加する用の配列を初期化
        $insert_data = [];
        // 取得したレコードの分だけループ
        foreach ($all_line as $key => $line) {
            // UTF-8形式に変換した1行分のデータを取得
            $line = mb_convert_encoding($line, 'UTF-8', 'ASCII, JIS, UTF-8, SJIS-win');
            // 1行分の情報を配列に格納
            $param = [
                'access_date' => $line['日時'],
                'access_user_name' => empty($line['ユーザー名']) ? Null : $line['ユーザー名'],
                'access_user_id' => empty($line['ユーザーID']) ? Null : $line['ユーザーID'],
                'access_user_code' => empty($line['ユーザーコード']) ? Null : $line['ユーザーコード'],
                'access_door_name' => $line['ドア名'],
                'access_door_id' => $line['ドアID'],
                'access_action' => $line['アクション'],
                'access_device_type' => $line['端末種別'],
            ];
            // テーブルに追加用の配列に1行分の情報を格納
            $insert_data[] = $param;
        }
        // 使用するテーブルをクリア
        AccessLog::query()->delete();
        AbnormalLog::query()->delete();
        // テーブルに追加
        AccessLog::upsert($insert_data, 'access_log_id');
        // 不要なレコードを削除
        AccessLog::whereNull('access_user_name')->delete();
        // #######################################################################################
        //                                      ログチェック
        // #######################################################################################
        // ユーザーの重複を削除して取得
        $users = AccessLog::groupBy('access_user_name', 'access_user_id')->select('access_user_name', 'access_user_id')->get();
        // エラー情報を格納する配列を初期化
        $abnormal_data = [];
        // ユーザーの分だけループ処理
        foreach($users as $user){
            // 対象ユーザーのログを取得
            $user_logs = AccessLog::where('access_user_id', $user->access_user_id)->orderBy('access_date', 'asc')->get();
            // 前回のレコードを格納する変数を初期化
            $previous = null;
            // ログの分だけループ処理
            foreach($user_logs as $user_log){
                // エラーかどうかを保持する変数を初期化
                $is_error = false;
                // $previousがnullではなく、今回と前回のアクションが同じ場合
                if($previous != null && $user_log->access_action == $previous->access_action){
                    // エラー判定をtrueに更新
                    $is_error = true;
                }
                // $is_errorがfalseであれば、更新する
                if($is_error == false){
                    $previous = $user_log;
                }
                // エラーの場合
                if($is_error){
                    // エラー情報を配列に格納
                    $abnormal_data[] = [
                        'access_date' => $user_log->access_date,
                        'access_user_name' => $user_log->access_user_name,
                        'abnormal_note' => '「'.$user_log->access_action.'」が続いています。',
                    ];
                    // 変数を初期化(初期化しないとずっとエラーになるので)
                    //$previous = null;
                }
            }
        }
        // 異常ログをテーブルに追加
        AbnormalLog::upsert($abnormal_data, 'abnormal_log_id');
        // 異常ログを取得
        $abnormal_logs = AbnormalLog::all();
        return view('welcome')->with([
            'abnormal_logs' => $abnormal_logs,
        ]);
    }
}
