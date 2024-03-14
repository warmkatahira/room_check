<?php

namespace App\Services\Progress;

// モデル
use App\Models\Customer;
use App\Models\Tag;
use App\Models\CustomerTag;
use App\Models\Item;
use App\Models\Base;
// 列挙
use App\Enums\ProgressRatioEnum;

class ProgressService
{
    // 荷主毎で集計した進捗を取得
    public function getProgressByCustomer()
    {
        // 項目を配列にセット
        $item_arr = $this->setItemArr();
        // 進捗情報を格納する配列をセット
        $progress_arr = [];
        $progress_ratio_arr = [];
        // その他情報を格納する配列をセット
        $tag_arr = [];
        // 荷主が紐付いている営業所を取得
        $customers = Customer::with('progresses')->orderBy('updated_at', 'desc')->get();
        // 荷主の分だけループ
        foreach($customers as $customer){
            // 今回の拠点IDのキーを配列にセットすると同時に、項目も一式セット
            $progress_arr[$customer->customer_name] = [
                'item' => $item_arr,
                'base_name' => $customer->base->base_name,
                'last_updated' => $customer->updated_at,
                'tags' => $customer->tags()->get(),
            ];
            // 荷主に紐付いている進捗を取得
            $progresses = $customer->progresses()->get();
            // 進捗の分だけループ処理
            foreach($progresses as $progress){
                // 値を更新する(valueがnullだったら0に対して更新)
                $progress_arr[$customer->customer_name]['item'][$progress->item_code]['value'] = (is_null($progress_arr[$customer->customer_name]['item'][$progress->item_code]['value']) ? 0 : $progress_arr[$customer->customer_name]['item'][$progress->item_code]['value']) + $progress->progress_value;
            }
            // 進捗率を取得
            $progress_ratio_arr[$customer->customer_name][ProgressRatioEnum::SHIPMENT_ORDER_QUANTITY_PROGRESS_RATIO_NAME] = $this->getProgressRatio($progress_arr[$customer->customer_name]['item'][ProgressRatioEnum::SHIPMENT_ORDER_QUANTITY]['value'], $progress_arr[$customer->customer_name]['item'][ProgressRatioEnum::INSPECTION_INCOMPLETE_SHIPMENT_ORDER_QUANTITY]['value']);
            $progress_ratio_arr[$customer->customer_name][ProgressRatioEnum::SHIPMENT_QUANTITY_PCS_PROGRESS_RATIO_NAME] = $this->getProgressRatio($progress_arr[$customer->customer_name]['item'][ProgressRatioEnum::SHIPMENT_QUANTITY_PCS]['value'], $progress_arr[$customer->customer_name]['item'][ProgressRatioEnum::INSPECTION_INCOMPLETE_SHIPMENT_QUANTITY_PCS]['value']);
            $progress_ratio_arr[$customer->customer_name][ProgressRatioEnum::SHIPMENT_QUANTITY_CS_PROGRESS_RATIO_NAME] = $this->getProgressRatio($progress_arr[$customer->customer_name]['item'][ProgressRatioEnum::SHIPMENT_QUANTITY_CS]['value'], $progress_arr[$customer->customer_name]['item'][ProgressRatioEnum::INSPECTION_INCOMPLETE_SHIPMENT_QUANTITY_CS]['value']);
        }
        return compact('progress_arr', 'progress_ratio_arr');
    }

    // 拠点毎で集計した進捗を取得
    public function getProgressByBase()
    {
        // 項目を配列にセット
        $item_arr = $this->setItemArr();
        // 進捗情報を格納する配列をセット
        $progress_arr = [];
        $progress_ratio_arr = [];
        // 荷主が紐付いている営業所を取得
        $bases = Base::join('customers', 'customers.base_id', 'bases.base_id')->orderBy('bases.base_id', 'asc')->get();
        // 拠点の分だけループ
        foreach($bases as $base){
            // 今回の拠点IDのキーを配列にセットすると同時に、項目も一式セット
            $progress_arr[$base->base_name] = [
                'item' => $item_arr
            ];
            // 拠点に紐付いている荷主を取得
            $customers = $base->customers()->get();
            // 拠点に紐付いている荷主の分だけループ
            foreach($customers as $customer){
                // 荷主と関連している進捗を取得
                $progresses = $customer->progresses()->get();
                // 進捗の分だけループ処理
                foreach($progresses as $progress){
                    // 値を更新する(valueがnullだったら0に対して更新)
                    $progress_arr[$base->base_name]['item'][$progress->item_code]['value'] = (is_null($progress_arr[$base->base_name]['item'][$progress->item_code]['value']) ? 0 : $progress_arr[$base->base_name]['item'][$progress->item_code]['value']) + $progress->progress_value;
                }
            }
            // 進捗率を取得
            $progress_ratio_arr[$base->base_name][ProgressRatioEnum::SHIPMENT_ORDER_QUANTITY_PROGRESS_RATIO_NAME] = $this->getProgressRatio($progress_arr[$base->base_name]['item'][ProgressRatioEnum::SHIPMENT_ORDER_QUANTITY]['value'], $progress_arr[$base->base_name]['item'][ProgressRatioEnum::INSPECTION_INCOMPLETE_SHIPMENT_ORDER_QUANTITY]['value']);
            $progress_ratio_arr[$base->base_name][ProgressRatioEnum::SHIPMENT_QUANTITY_PCS_PROGRESS_RATIO_NAME] = $this->getProgressRatio($progress_arr[$base->base_name]['item'][ProgressRatioEnum::SHIPMENT_QUANTITY_PCS]['value'], $progress_arr[$base->base_name]['item'][ProgressRatioEnum::INSPECTION_INCOMPLETE_SHIPMENT_QUANTITY_PCS]['value']);
            $progress_ratio_arr[$base->base_name][ProgressRatioEnum::SHIPMENT_QUANTITY_CS_PROGRESS_RATIO_NAME] = $this->getProgressRatio($progress_arr[$base->base_name]['item'][ProgressRatioEnum::SHIPMENT_QUANTITY_CS]['value'], $progress_arr[$base->base_name]['item'][ProgressRatioEnum::INSPECTION_INCOMPLETE_SHIPMENT_QUANTITY_CS]['value']);
        }
        return compact('progress_arr', 'progress_ratio_arr');
    }

    // タグ毎で集計した進捗を取得
    public function getProgressByTag()
    {
        // 項目を配列にセット
        $item_arr = $this->setItemArr();
        // 進捗情報を格納する配列をセット
        $progress_arr = [];
        $progress_ratio_arr = [];
        // タグを全て取得
        $tags = Tag::getAll()->get();
        // タグの分だけループ
        foreach($tags as $tag){
            // tag_idを指定して、タグに紐付いている荷主を取得
            $customer_tags = CustomerTag::where('tag_id', $tag->tag_id)->get();
            // 今回のタグ用のキーを配列にセットすると同時に、項目も一式セット
            $progress_arr[$tag->tag_name] = [
                'item' => $item_arr
            ];
            // タグに紐付いている荷主の分だけループ
            foreach($customer_tags as $customer_tag){
                // タグと関連している進捗を取得
                $progresses = $customer_tag->progresses()->get();
                // 進捗の分だけループ処理
                foreach($progresses as $progress){
                    // 値を更新する(valueがnullだったら0に対して更新)
                    $progress_arr[$tag->tag_name]['item'][$progress->item_code]['value'] = (is_null($progress_arr[$tag->tag_name]['item'][$progress->item_code]['value']) ? 0 : $progress_arr[$tag->tag_name]['item'][$progress->item_code]['value']) + $progress->progress_value;
                }
            }
            // 進捗率を取得
            $progress_ratio_arr[$tag->tag_name][ProgressRatioEnum::SHIPMENT_ORDER_QUANTITY_PROGRESS_RATIO_NAME] = $this->getProgressRatio($progress_arr[$tag->tag_name]['item'][ProgressRatioEnum::SHIPMENT_ORDER_QUANTITY]['value'], $progress_arr[$tag->tag_name]['item'][ProgressRatioEnum::INSPECTION_INCOMPLETE_SHIPMENT_ORDER_QUANTITY]['value']);
            $progress_ratio_arr[$tag->tag_name][ProgressRatioEnum::SHIPMENT_QUANTITY_PCS_PROGRESS_RATIO_NAME] = $this->getProgressRatio($progress_arr[$tag->tag_name]['item'][ProgressRatioEnum::SHIPMENT_QUANTITY_PCS]['value'], $progress_arr[$tag->tag_name]['item'][ProgressRatioEnum::INSPECTION_INCOMPLETE_SHIPMENT_QUANTITY_PCS]['value']);
            $progress_ratio_arr[$tag->tag_name][ProgressRatioEnum::SHIPMENT_QUANTITY_CS_PROGRESS_RATIO_NAME] = $this->getProgressRatio($progress_arr[$tag->tag_name]['item'][ProgressRatioEnum::SHIPMENT_QUANTITY_CS]['value'], $progress_arr[$tag->tag_name]['item'][ProgressRatioEnum::INSPECTION_INCOMPLETE_SHIPMENT_QUANTITY_CS]['value']);
        }
        return compact('progress_arr', 'progress_ratio_arr');
    }

    // 項目を配列にセット
    public function setItemArr()
    {
        // 項目を格納する配列をセット
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
        return $item_arr;
    }

    // 進捗率を取得
    public function getProgressRatio($base_quantity, $inspection_incomplete_quantity)
    {
        // 母数と残数がnull以外であれば取得する
        if(!is_null($base_quantity) && !is_null($inspection_incomplete_quantity)){
            // ((母数 - 残数) / 母数) × 100
            return (($base_quantity - $inspection_incomplete_quantity) / $base_quantity) * 100;
        }
        return null;
    }
}