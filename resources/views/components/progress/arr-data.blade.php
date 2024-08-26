<div class="grid grid-cols-12 gap-4">
    @foreach($data['progress_arr'] as $key => $value)
        <div class="col-span-12 xl:col-span-3 flex flex-col">
            @if(isset($value['last_updated']))
                <div class="py-1 px-3 text-right">
                    <p class="text-xs"><i class="las la-clock la-lg mr-1"></i>{{ CarbonImmutable::parse($value['last_updated'])->isoFormat('YYYY年MM月DD日(ddd) HH:mm:ss').'('.CarbonImmutable::parse($value['last_updated'])->diffForHumans().')' }}</p>
                </div>
            @endif
            @php
                // 初期値をセット
                $bg = 'bg-theme-main';
                $bg_sub = 'bg-theme-sub';
                $border = 'border-theme-main';
                $icon_type = null;
                if(isset($value['alert'])){
                    $icon_type = $value['alert'] ? 'alert' : null;
                }
                // 配列があって、値がTrueであれば色を変える
                if(isset($value['shipping_confirmed_at_today']) && $value['shipping_confirmed_at_today']){
                    // 荷主の更新時間よりも出荷確定日時の方が最新の場合(出荷確定後、動いていない)
                    if($value['last_updated'] <= $value['shipping_confirmed_at']){
                        $bg = 'bg-orange-500';
                        $bg_sub = 'bg-orange-200';
                        $border = 'border-orange-500';
                        $icon_type = 'shipping_confirmed';
                    }
                    // 出荷確定日時よりも荷主の更新時間の方が最新の場合(出荷確定後、動いている)
                    if($value['last_updated'] > $value['shipping_confirmed_at']){
                        $bg = 'bg-sky-500';
                        $bg_sub = 'bg-sky-200';
                        $border = 'border-sky-500';
                    }
                }
            @endphp
            <div class="{{ $bg }} py-2 px-3 flex flex-col">
                @if(isset($value['base_name']))
                    <div class="flex flex-row">
                        <p class="text-white text-xs mb-1">{{ $value['base_name'] }}</p>
                        @if($icon_type == 'shipping_confirmed')
                            <lord-icon src="https://cdn.lordicon.com/ctlnzcle.json" trigger="loop" delay="1000" style="width:35px;height:35px" class="ml-auto"></lord-icon>
                        @endif
                        @if($icon_type == 'alert')
                            <lord-icon src="https://cdn.lordicon.com/jxzkkoed.json" trigger="loop" delay="1000" style="width:35px;height:35px" class="ml-auto"></lord-icon>
                        @endif
                    </div>
                @endif
                @if($icon_type == 'alert')
                    <div class="alert_message_div">
                        <ul>
                            @foreach($value['alert_message'] as $alert_message)
                                <li>{{ $alert_message }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <p class="text-white text-center flex-1">{{ $value['title'] }}</p>
            </div>
            @if(isset($value['tags']) && $value['tags']->count() > 0)
                <div class="{{ $bg }} px-1 py-1 grid grid-cols-12 gap-2">
                    @foreach($value['tags'] as $tag)
                        <span class="col-span-6 xl:col-span-4 text-xs text-white text-center"><i class="las la-tag mr-1"></i>{{ $tag->tag_name }}</span>
                    @endforeach
                </div>
            @endif
            @foreach($value['item'] as $item)
                @if(!is_null($item['value']))
                    <div class="{{ $bg_sub .' '. $border }} py-1 px-3 border-b border-x flex flex-row">
                        <p class="text-sm text-black w-8/12">{{ $item['item_name'] }}</p>
                        <p class="text-sm text-black pr-3 w-3/12 text-right">{{ number_format($item['value']) }}</p>
                        <p class="text-sm text-black w-1/12 text-left">{{ $item['item_unit'] }}</p>
                    </div>
                @endif
            @endforeach
            @foreach($data['progress_ratio_arr'][$key] as $ratio_key => $ratio_value)
                @if(!is_null($ratio_value))
                    <div class="{{ $bg_sub .' '. $border }} py-1 px-3 border-b border-x flex flex-row">
                        <p class="text-sm text-black w-8/12">{{ $ratio_key }}</p>
                        <p class="text-sm text-black pr-3 w-3/12 text-right">
                            @if($ratio_value == 100)
                                {{ number_format($ratio_value, 0) }}
                            @else
                                {{ number_format($ratio_value, 1) }}
                            @endif
                        </p>
                        <p class="text-sm text-black w-1/12 text-left"><i class="las la-percent mt-0.5"></i></p>
                    </div>
                @endif
            @endforeach
            @if(isset($value['information']) && $value['information']->count() > 0)
                @foreach($value['information'] as $information)
                    <div class="{{ $bg_sub .' '. $border }} py-1 px-3 border-b border-x flex flex-row">
                        <p class="text-sm text-black w-8/12">{{ $information->label }}</p>
                        <p class="text-sm text-black pr-3 w-3/12 text-right">{{ number_format($information->value, 0) }}</p>
                        <p class="text-sm text-black w-1/12 text-left">{{ $information->unit }}</p>
                    </div>
                @endforeach
            @endif
        </div>
    @endforeach
</div>