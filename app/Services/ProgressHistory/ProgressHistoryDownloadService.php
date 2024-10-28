<?php

namespace App\Services\ProgressHistory;

// モデル
use App\Models\ProgressHistory;
// その他
use Symfony\Component\HttpFoundation\StreamedResponse;
use Carbon\CarbonImmutable;

class ProgressHistoryDownloadService
{
    // ダウンロードするデータを取得
    public function getDownloadData($progress_histories)
    {
        // チャンクサイズを指定
        $chunkSize = 1000;
        $response = new StreamedResponse(function () use ($progress_histories, $chunkSize) {
            // ハンドルを取得
            $handle = fopen('php://output', 'wb');
            // BOMを書き込む
            fwrite($handle, "\xEF\xBB\xBF");
            // システムに定義してあるヘッダーを取得し、書き込む
            $header = ProgressHistory::downloadHeader();
            fputcsv($handle, $header);
            // レコードをチャンクごとに書き込む
            $progress_histories->chunk($chunkSize, function ($progress_histories) use ($handle) {
                // 進捗履歴の分だけループ
                foreach($progress_histories as $progress_history){
                    $row = [
                        CarbonImmutable::parse($progress_history->date)->format('Y-m-d'),
                        CarbonImmutable::parse($progress_history->created_at)->format('H:i'),
                        $progress_history->customer->base->base_name,
                        $progress_history->customer->customer_name,
                        $progress_history->item->item_name.'('.$progress_history->item->item_unit.')',
                        $progress_history->progress_value,
                    ];
                    fputcsv($handle, $row);
                };
            });
            // ファイルを閉じる
            fclose($handle);
        });
        return $response;
    }
}