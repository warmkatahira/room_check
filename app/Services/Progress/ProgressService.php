<?php

namespace App\Services\Progress;

// モデル
use App\Models\Customer;
use App\Models\Tag;
use App\Models\CustomerTag;
use App\Models\Item;
use App\Models\Base;
use App\Models\KintaiKintai;
// 列挙
use App\Enums\ProgressRatioEnum;
// その他
use Carbon\CarbonImmutable;

class ProgressService
{
    // 荷主毎で集計した進捗を取得
    public function getProgressByCustomer($request)
    {
        // 拠点が指定されていたらセッションに格納
        if($request->base_select_enter){
            session(['search_base_id' => $request->search_base_id]);
        }else{
            session()->forget(['search_base_id']);
        }
        // 項目を配列にセット
        $item_arr = $this->setItemArr();
        // 進捗情報を格納する配列をセット
        $progress_arr = [];
        $progress_ratio_arr = [];
        // その他情報を格納する配列をセット
        $tag_arr = [];
        // 荷主が紐付いている拠点を取得
        $customers = Customer::with('progresses')
                            ->orderBy('updated_at', 'desc');
        // base_select_enterがtrueかつ、base_idがnullでなければ条件を適用
        if($request->base_select_enter && !is_null($request->search_base_id)){
            $customers = $customers->where('base_id', $request->search_base_id);
        }
        // 取得
        $customers = $customers->get();
        // 荷主の分だけループ
        foreach($customers as $customer){
            // 進捗が存在する荷主のみ処理を継続
            if($customer->progresses->count() > 0){
                // 出荷確定日時が本日であれば「True」、違えば「False」
                $shipping_confirmed_at_today = false;
                if(!is_null($customer->shipping_confirmed_at) && CarbonImmutable::parse($customer->shipping_confirmed_at)->format('Y-m-d') == CarbonImmutable::now()->format('Y-m-d')){
                    $shipping_confirmed_at_today = true;
                }
                // 配列のキーに使用する情報をセット
                $key = $customer->customer_code;
                // 今回の拠点IDのキーを配列にセットすると同時に、項目も一式セット
                $progress_arr[$key] = [
                    'title' => $customer->customer_name,
                    'customer_code' => $customer->customer_code,
                    'item' => $item_arr,
                    'base_name' => $customer->base->base_name,
                    'last_updated' => $customer->updated_at,
                    'tags' => $customer->customer_tags()->get(),
                    'shipping_confirmed_at' => $customer->shipping_confirmed_at,
                    'shipping_confirmed_at_today' => $shipping_confirmed_at_today,
                    'alert' => false,
                    'alert_message' => null,
                    'information' => $customer->informations,
                    'comment' => $customer->comment,
                ];
                // 荷主に紐付いている進捗を取得
                $progresses = $customer->progresses()->get();
                // 進捗の分だけループ処理
                foreach($progresses as $progress){
                    // 値を更新する(valueがnullだったら0に対して更新)
                    $progress_arr[$key]['item'][$progress->item_code]['value'] = (is_null($progress_arr[$key]['item'][$progress->item_code]['value']) ? 0 : $progress_arr[$key]['item'][$progress->item_code]['value']) + $progress->progress_value;
                }
                // 進捗率を取得
                $progress_ratio_arr[$key][ProgressRatioEnum::SHIPMENT_ORDER_QUANTITY_PROGRESS_RATIO_NAME] = $this->getProgressRatio($progress_arr[$key]['item'][ProgressRatioEnum::SHIPMENT_ORDER_QUANTITY]['value'], $progress_arr[$key]['item'][ProgressRatioEnum::INSPECTION_INCOMPLETE_SHIPMENT_ORDER_QUANTITY]['value']);
                $progress_ratio_arr[$key][ProgressRatioEnum::SHIPMENT_QUANTITY_PCS_PROGRESS_RATIO_NAME] = $this->getProgressRatio($progress_arr[$key]['item'][ProgressRatioEnum::SHIPMENT_QUANTITY_PCS]['value'], $progress_arr[$key]['item'][ProgressRatioEnum::INSPECTION_INCOMPLETE_SHIPMENT_QUANTITY_PCS]['value']);
                $progress_ratio_arr[$key][ProgressRatioEnum::SHIPMENT_QUANTITY_BL_PROGRESS_RATIO_NAME] = $this->getProgressRatio($progress_arr[$key]['item'][ProgressRatioEnum::SHIPMENT_QUANTITY_BL]['value'], $progress_arr[$key]['item'][ProgressRatioEnum::INSPECTION_INCOMPLETE_SHIPMENT_QUANTITY_BL]['value']);
                $progress_ratio_arr[$key][ProgressRatioEnum::SHIPMENT_QUANTITY_CS_PROGRESS_RATIO_NAME] = $this->getProgressRatio($progress_arr[$key]['item'][ProgressRatioEnum::SHIPMENT_QUANTITY_CS]['value'], $progress_arr[$key]['item'][ProgressRatioEnum::INSPECTION_INCOMPLETE_SHIPMENT_QUANTITY_CS]['value']);
            }
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
        // 拠点を取得
        $bases = Base::getAll()->get();
        // 拠点の分だけループ
        foreach($bases as $base){
            // 荷主が存在するかつ進捗が存在する拠点のみ処理を継続
            if($base->customers()->count() > 0 && Customer::getProgressByBase($base->base_id)){
                // 拠点に紐付いている荷主分類数を取得
                $cutomer_category_count = Customer::getCustomerCategoryCountByBase($base->base_id);
                // 配列のキーに使用する情報をセット
                $key = $base->base_name.'('.$cutomer_category_count.'社)';
                // 今回の拠点IDのキーを配列にセットすると同時に、項目も一式セット
                $progress_arr[$key] = [
                    'title' => $key,
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
                        $progress_arr[$key]['item'][$progress->item_code]['value'] = (is_null($progress_arr[$key]['item'][$progress->item_code]['value']) ? 0 : $progress_arr[$key]['item'][$progress->item_code]['value']) + $progress->progress_value;
                    }
                }
                // 進捗率を取得
                $progress_ratio_arr[$key][ProgressRatioEnum::SHIPMENT_ORDER_QUANTITY_PROGRESS_RATIO_NAME] = $this->getProgressRatio($progress_arr[$key]['item'][ProgressRatioEnum::SHIPMENT_ORDER_QUANTITY]['value'], $progress_arr[$key]['item'][ProgressRatioEnum::INSPECTION_INCOMPLETE_SHIPMENT_ORDER_QUANTITY]['value']);
                $progress_ratio_arr[$key][ProgressRatioEnum::SHIPMENT_QUANTITY_PCS_PROGRESS_RATIO_NAME] = $this->getProgressRatio($progress_arr[$key]['item'][ProgressRatioEnum::SHIPMENT_QUANTITY_PCS]['value'], $progress_arr[$key]['item'][ProgressRatioEnum::INSPECTION_INCOMPLETE_SHIPMENT_QUANTITY_PCS]['value']);
                $progress_ratio_arr[$key][ProgressRatioEnum::SHIPMENT_QUANTITY_BL_PROGRESS_RATIO_NAME] = $this->getProgressRatio($progress_arr[$key]['item'][ProgressRatioEnum::SHIPMENT_QUANTITY_BL]['value'], $progress_arr[$key]['item'][ProgressRatioEnum::INSPECTION_INCOMPLETE_SHIPMENT_QUANTITY_BL]['value']);
                $progress_ratio_arr[$key][ProgressRatioEnum::SHIPMENT_QUANTITY_CS_PROGRESS_RATIO_NAME] = $this->getProgressRatio($progress_arr[$key]['item'][ProgressRatioEnum::SHIPMENT_QUANTITY_CS]['value'], $progress_arr[$key]['item'][ProgressRatioEnum::INSPECTION_INCOMPLETE_SHIPMENT_QUANTITY_CS]['value']);
            }
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
            // 荷主が存在するかつ進捗が存在するタグのみ処理を継続
            if($tag->customers()->count() > 0 && Tag::getProgressByTag($tag->tag_id)){
                // タグに紐付いている荷主分類数を取得
                $cutomer_category_count = CustomerTag::getCustomerCategoryCountByTag($tag->tag_id);
                // 配列のキーに使用する情報をセット
                $key = $tag->tag_name.'('.$cutomer_category_count.'社)';
                // tag_idを指定して、タグに紐付いている荷主を取得
                $customer_tags = CustomerTag::where('tag_id', $tag->tag_id)->get();
                // 今回のタグ用のキーを配列にセットすると同時に、項目も一式セット
                $progress_arr[$key] = [
                    'title' => $key,
                    'item' => $item_arr
                ];
                // タグに紐付いている荷主の分だけループ
                foreach($customer_tags as $customer_tag){
                    // タグと関連している進捗を取得
                    $progresses = $customer_tag->progresses()->get();
                    // 進捗の分だけループ処理
                    foreach($progresses as $progress){
                        // 値を更新する(valueがnullだったら0に対して更新)
                        $progress_arr[$key]['item'][$progress->item_code]['value'] = (is_null($progress_arr[$key]['item'][$progress->item_code]['value']) ? 0 : $progress_arr[$key]['item'][$progress->item_code]['value']) + $progress->progress_value;
                    }
                }
                // 進捗率を取得
                $progress_ratio_arr[$key][ProgressRatioEnum::SHIPMENT_ORDER_QUANTITY_PROGRESS_RATIO_NAME] = $this->getProgressRatio($progress_arr[$key]['item'][ProgressRatioEnum::SHIPMENT_ORDER_QUANTITY]['value'], $progress_arr[$key]['item'][ProgressRatioEnum::INSPECTION_INCOMPLETE_SHIPMENT_ORDER_QUANTITY]['value']);
                $progress_ratio_arr[$key][ProgressRatioEnum::SHIPMENT_QUANTITY_PCS_PROGRESS_RATIO_NAME] = $this->getProgressRatio($progress_arr[$key]['item'][ProgressRatioEnum::SHIPMENT_QUANTITY_PCS]['value'], $progress_arr[$key]['item'][ProgressRatioEnum::INSPECTION_INCOMPLETE_SHIPMENT_QUANTITY_PCS]['value']);
                $progress_ratio_arr[$key][ProgressRatioEnum::SHIPMENT_QUANTITY_BL_PROGRESS_RATIO_NAME] = $this->getProgressRatio($progress_arr[$key]['item'][ProgressRatioEnum::SHIPMENT_QUANTITY_BL]['value'], $progress_arr[$key]['item'][ProgressRatioEnum::INSPECTION_INCOMPLETE_SHIPMENT_QUANTITY_BL]['value']);
                $progress_ratio_arr[$key][ProgressRatioEnum::SHIPMENT_QUANTITY_CS_PROGRESS_RATIO_NAME] = $this->getProgressRatio($progress_arr[$key]['item'][ProgressRatioEnum::SHIPMENT_QUANTITY_CS]['value'], $progress_arr[$key]['item'][ProgressRatioEnum::INSPECTION_INCOMPLETE_SHIPMENT_QUANTITY_CS]['value']);
            }
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
        // 母数と残数がnullであれば取得する
        if(!is_null($base_quantity) && !is_null($inspection_incomplete_quantity)){
            // 母数が0であれば0を返す
            if($base_quantity == 0){
                return 0;
            }
            // ((母数 - 残数) / 母数) × 100
            return (($base_quantity - $inspection_incomplete_quantity) / $base_quantity) * 100;
        }
        return null;
    }

    // 出勤中人数を拠点毎に整理
    public function getWorkingInfo()
    {
        // 現在の営業所毎の出勤人数を取得
        $employee_count = KintaiKintai::getCurrentWorkingEmployeesCountByBase()->toArray();
        // 出勤情報を格納する配列を用意
        $working_info = [];
        // 拠点の分だけループ処理
        foreach(Base::getAll()->get() as $base){
            // 配列に要素を追加
            $working_info[$base->base_id] = [
                '拠点' => $base->shortened_base_name,
                '社員' => 0,
                'パート' => 0,
            ];
            // 出勤人数情報の分だけループ処理
            foreach($employee_count as $key => $value){
                // 拠点が同じである場合
                if($value['base_id'] == $base->base_id){
                    // 従業員区分に「社員」が含まれている場合と「パート」が含まれている場合で、計上する要素を可変
                    if(strpos($value['employee_category_name'], '社員') !== false){
                        $working_info[$base->base_id]['社員']+= $value['working_count'];
                    }
                    if(strpos($value['employee_category_name'], 'パート') !== false){
                        $working_info[$base->base_id]['パート']+= $value['working_count'];
                    }
                    // 出勤人数情報を削除
                    unset($employee_count[$key]);
                }
            }
        }
        return $working_info;
    }
}