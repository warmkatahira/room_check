<div class="grid grid-cols-12 gap-4">
    @php
        $shipment_quantity_pcs = '';
        $inspection_incomplete_shipment_quantity_pcs = '';
    @endphp
    @foreach($arr as $key => $value)
        <div class="col-span-12 xl:col-span-3 flex flex-col">
            <div class="bg-theme-main py-3 px-3 border border-theme-main">
                <p class="text-white text-center">{{ $key }}</p>
            </div>
            @foreach($value as $item)
                @if(!is_null($item['value']))
                    <div class="bg-theme-sub py-2 px-3 border-b border-x border-theme-main flex flex-row">
                        <p class="text-sm text-black w-8/12">{{ $item['item_name'] }}</p>
                        <p class="text-sm text-black pr-3 w-3/12 text-right">{{ number_format($item['value']) }}</p>
                        <p class="text-sm text-black w-1/12 text-left">{{ $item['item_unit'] }}</p>
                        @php
                            if($item['item_code'] == 'shipment_quantity_pcs'){
                                $shipment_quantity_pcs = $item['value'];
                            }
                            if($item['item_code'] == 'inspection_incomplete_shipment_quantity_pcs'){
                                $inspection_incomplete_shipment_quantity_pcs = $item['value'];
                            }
                        @endphp
                    </div>
                @endif
            @endforeach
            @if($shipment_quantity_pcs != '' && $inspection_incomplete_shipment_quantity_pcs != '')
                @php
                    $progress_ratio = (($shipment_quantity_pcs - $inspection_incomplete_shipment_quantity_pcs) / $shipment_quantity_pcs) * 100;
                @endphp
                <div class="bg-theme-sub py-2 px-3 border-b border-x border-theme-main flex flex-row">
                    <p class="text-sm text-black w-8/12">進捗率</p>
                    <p class="text-sm text-black pr-3 w-3/12 text-right">{{ number_format($progress_ratio, 2) }}</p>
                    <p class="text-sm text-black w-1/12 text-left"><i class="las la-percent"></i></p>
                </div>
            @endif
        </div>
    @endforeach
</div>