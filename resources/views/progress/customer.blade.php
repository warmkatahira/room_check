<x-app-layout>
    <!-- カテゴリ選択 -->
    <x-progress.category-select />
    <!-- 荷主単位 -->
    <div class="grid grid-cols-12 gap-4 mt-5">
        @foreach($customers as $customer)
            <!-- 進捗がある荷主だけ表示 -->
            @if(count($customer->progresses) > 0)
                <div class="col-span-12 xl:col-span-3 flex flex-col">
                    <div class="bg-theme-main py-1 px-3 border border-theme-main flex flex-row">
                        <p class="text-sm text-white w-4/12 text-left">{{ $customer->base->base_name }}</p>
                        <p class="text-xs text-white w-8/12 text-right">{{ '最終更新：'.\Carbon\CarbonImmutable::parse(LatestUpdatedAtGetFunc::get($customer->customer_code))->isoFormat('YYYY年MM月DD日(ddd) HH時mm分') }}</p>
                    </div>
                    <div class="bg-theme-main py-3">
                        <p class="text-white text-center">{{ $customer->customer_name }}</p>
                    </div>
                    <div class="bg-theme-main px-1 py-1 grid grid-cols-12 gap-2">
                        @foreach($customer->tags()->get() as $tag)
                            <span class="col-span-6 xl:col-span-4 text-xs text-white text-center"><i class="las la-tag"></i>{{ $tag->tag_name }}</span>
                        @endforeach
                    </div>
                    @foreach($customer->progresses as $progress)
                        <div class="bg-theme-sub py-2 px-3 border-b border-x border-theme-main flex flex-row">
                            <p class="text-sm text-black w-8/12">{{ $progress->item->item_name }}</p>
                            <p class="text-sm text-black pr-3 w-3/12 text-right">{{ number_format($progress->progress_value) }}</p>
                            <p class="text-sm text-black w-1/12 text-left">{{ $progress->item->item_unit }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
        @endforeach
    </div>
</x-app-layout>