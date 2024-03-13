<x-app-layout>
    <!-- カテゴリ選択 -->
    <x-progress.category-select />
    <!-- 荷主単位 -->
    <div class="grid grid-cols-12 gap-4 mt-5">
        @foreach($customers as $customer)
            <!-- 進捗がある荷主だけ表示 -->
            @if(count($customer->progresses) > 0)
                <div class="col-span-12 xl:col-span-3 flex flex-col">
                    @php
                        $bg = 'bg-theme-main';
                        // 最終出荷確定日が現在の日付と同じであれば背景色を変更
                        if($customer->last_shipping_confirmed_date == CarbonImmutable::now()->format('Y-m-d')){
                            $bg = 'bg-orange-600';
                        }   
                    @endphp
                    <div class="{{ $bg }} py-1 px-3 flex flex-row">
                        <p class="text-xs text-white w-5/12 text-left">{{ $customer->base->base_name }}</p>
                        <p class="text-xs text-white w-7/12 text-right"><i class="las la-clock la-lg mr-1"></i>{{ CarbonImmutable::parse($customer->updated_at)->isoFormat('YYYY年MM月DD日(ddd) HH時mm分') }}</p>
                        {{-- <p class="text-xs text-white w-8/12 text-right">{{ '最終更新：'.CarbonImmutable::parse(LatestUpdatedAtGetFunc::get($customer->customer_code))->isoFormat('YYYY年MM月DD日(ddd) HH時mm分') }}</p> --}}
                    </div>
                    <div class="bg-theme-main py-3">
                        <p class="text-white text-center">{{ $customer->customer_name }}</p>
                    </div>
                    <div class="bg-theme-main px-1 py-1 grid grid-cols-12 gap-2">
                        @foreach($customer->tags()->get() as $tag)
                            <span class="col-span-6 xl:col-span-4 text-xs text-white text-center"><i class="las la-tag"></i>{{ $tag->tag_name }}</span>
                        @endforeach
                    </div>
                    @php
                        $shipment_quantity_pcs = '';
                        $inspection_incomplete_shipment_quantity_pcs = '';
                    @endphp
                    @foreach($customer->progresses as $progress)
                        <div class="bg-theme-sub py-2 px-3 border-b border-x border-theme-main flex flex-row">
                            <p class="text-sm text-black w-8/12">{{ $progress->item->item_name }}</p>
                            <p class="text-sm text-black pr-3 w-3/12 text-right">{{ number_format($progress->progress_value) }}</p>
                            <p class="text-sm text-black w-1/12 text-left">{{ $progress->item->item_unit }}</p>
                            @php
                                if($progress->item_code == 'shipment_quantity_pcs'){
                                    $shipment_quantity_pcs = $progress->progress_value;
                                }
                                if($progress->item_code == 'inspection_incomplete_shipment_quantity_pcs'){
                                    $inspection_incomplete_shipment_quantity_pcs = $progress->progress_value;
                                }
                            @endphp
                        </div>
                    @endforeach
                    @if($shipment_quantity_pcs != '' && $inspection_incomplete_shipment_quantity_pcs != '')
                        @php
                            $progress_ratio = (($shipment_quantity_pcs - $inspection_incomplete_shipment_quantity_pcs) / $shipment_quantity_pcs) * 100;
                        @endphp
                        <div class="bg-theme-sub py-2 px-3 border-b border-x border-theme-main flex flex-row">
                            <p class="text-sm text-black w-8/12">進捗率</p>
                            <p class="text-sm text-black pr-3 w-3/12 text-right">{{ number_format($progress_ratio, 1) }}</p>
                            <p class="text-sm text-black w-1/12 text-left"><i class="las la-percent"></i></p>
                        </div>
                    @endif
                </div>
            @endif
        @endforeach
    </div>
</x-app-layout>