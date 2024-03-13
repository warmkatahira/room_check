<?php

namespace App\Services\Progress;

// モデル
use App\Models\Tag;
use App\Models\CustomerTag;
use App\Models\Item;
use App\Models\Base;

class ProgressService
{
    // 拠点毎で集計した進捗を取得
    public function getProgressByBase()
    {
        // 情報を格納する配列をセット
        $item_arr = [];
        // 項目を全て取得
        $items = Item::getAll()->get();
        // 項目を配列にセット
        foreach($items as $item){
            $item_arr[$item->item_code] = [
                'item_code' => $item->item_code,
                'item_name' => $item->item_name,
                'value' => null,
                'item_unit' => $item->item_unit,
            ];
        }
        // 情報を格納する配列をセット
        $base_progress_arr = [];
        // 荷主が紐付いている営業所を全て取得
        $bases = Base::join('customers', 'customers.base_id', 'bases.base_id')->get();
        // 拠点の分だけループ
        foreach($bases as $base){
            // 今回の拠点IDのキーを配列にセットすると同時に、項目も一式セット
            $base_progress_arr[$base->base_name] = $item_arr;
            // 拠点に紐付いている荷主を取得
            $customers = $base->customers()->get();
            // 拠点に紐付いている荷主の分だけループ
            foreach($customers as $customer){
                // 荷主と関連している進捗を取得
                $progresses = $customer->progresses()->get();
                // 進捗の分だけループ処理
                foreach($progresses as $progress){
                    // 値を更新する(valueがnullだったら0に対して更新)
                    $base_progress_arr[$base->base_name][$progress->item_code]['value'] = (is_null($base_progress_arr[$base->base_name][$progress->item_code]['value']) ? 0 : $base_progress_arr[$base->base_name][$progress->item_code]['value']) + $progress->progress_value;
                }
            }
        }
        return $base_progress_arr;
    }

    // タグ毎で集計した進捗を取得
    public function getProgressByTag()
    {
        // 情報を格納する配列をセット
        $item_arr = [];
        // 項目を全て取得
        $items = Item::getAll()->get();
        // 項目を配列にセット
        foreach($items as $item){
            $item_arr[$item->item_code] = [
                'item_code' => $item->item_code,
                'item_name' => $item->item_name,
                'value' => null,
                'item_unit' => $item->item_unit,
            ];
        }
        // 情報を格納する配列をセット
        $tag_progress_arr = [];
        // タグを全て取得
        $tags = Tag::getAll()->get();
        // タグの分だけループ
        foreach($tags as $tag){
            // tag_idを指定して、タグに紐付いている荷主を取得
            $customer_tags = CustomerTag::where('tag_id', $tag->tag_id)->get();
            // 今回のタグ用のキーを配列にセットすると同時に、項目も一式セット
            $tag_progress_arr[$tag->tag_name] = $item_arr;
            // タグに紐付いている荷主の分だけループ
            foreach($customer_tags as $customer_tag){
                // 荷主と関連している進捗を取得
                $progresses = $customer_tag->progresses()->get();
                // 進捗の分だけループ処理
                foreach($progresses as $progress){
                    // 値を更新する(valueがnullだったら0に対して更新)
                    $tag_progress_arr[$tag->tag_name][$progress->item_code]['value'] = (is_null($tag_progress_arr[$tag->tag_name][$progress->item_code]['value']) ? 0 : $tag_progress_arr[$tag->tag_name][$progress->item_code]['value']) + $progress->progress_value;
                }
            }
        }
        return $tag_progress_arr;
    }
}