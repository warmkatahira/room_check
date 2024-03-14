<div class="grid grid-cols-12 gap-4">
    @foreach($data['progress_arr'] as $key => $value)
        <div class="col-span-12 xl:col-span-3 flex flex-col">
            @if(isset($data['last_updated_arr']))
                <div class="py-1 px-3 text-right">
                    <p class="text-xs"><i class="las la-clock la-lg mr-1"></i>{{ CarbonImmutable::parse($data['last_updated_arr'][$key])->isoFormat('YYYY年MM月DD日(ddd) HH:mm:ss') }}</p>
                </div>
            @endif
            <div class="bg-theme-main py-3 px-3 border border-theme-main">
                <p class="text-white text-center">{{ $key }}</p>
            </div>
            @if(isset($data['tag_arr']))
                <div class="bg-theme-main px-1 py-1 grid grid-cols-12 gap-2">
                    @foreach($data['tag_arr'][$key] as $tag)
                        <span class="col-span-6 xl:col-span-4 text-xs text-white text-center"><i class="las la-tag"></i>{{ $tag->tag_name }}</span>
                    @endforeach
                </div>
            @endif
            @foreach($value as $item)
                @if(!is_null($item['value']))
                    <div class="bg-theme-sub py-1 px-3 border-b border-x border-theme-main flex flex-row">
                        <p class="text-sm text-black w-8/12">{{ $item['item_name'] }}</p>
                        <p class="text-sm text-black pr-3 w-3/12 text-right">{{ number_format($item['value']) }}</p>
                        <p class="text-sm text-black w-1/12 text-left">{{ $item['item_unit'] }}</p>
                    </div>
                @endif
            @endforeach
            @foreach($data['progress_ratio_arr'][$key] as $ratio_key => $ratio_value)
                @if(!is_null($ratio_value))
                    <div class="bg-theme-sub py-1 px-3 border-b border-x border-theme-main flex flex-row">
                        <p class="text-sm text-black w-8/12">{{ $ratio_key }}</p>
                        <p class="text-sm text-black pr-3 w-3/12 text-right">{{ number_format($ratio_value, 2) }}</p>
                        <p class="text-sm text-black w-1/12 text-left"><i class="las la-percent"></i></p>
                    </div>
                @endif
            @endforeach
        </div>
    @endforeach
</div>