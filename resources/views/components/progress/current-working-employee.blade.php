<p class="text-xl mb-0.5"><i class="las la-user la-lg"></i>出勤中人数</p>
<div class="grid grid-cols-12 gap-4 mb-3">
    @foreach($workingInfo as $info)
        <div class="col-span-6 xl:col-span-1 text-center">
            <p class="bg-black text-white">{{ $info['拠点'] }}</p>
            <div class="grid grid-cols-2 border-b border-gray-300">
                <p class="bg-gray-300 text-sm py-2 col-span-1">社員</p>
                <p class="bg-white text-xl py-1 col-span-1">{{ $info['社員'] }}<span class="text-xs ml-1">人</span></p>
            </div>
            <div class="grid grid-cols-2">
                <p class="bg-gray-300 text-sm py-2 col-span-1">パート</p>
                <p class="bg-white text-xl py-1 col-span-1">{{ $info['パート'] }}<span class="text-xs ml-1">人</span></p>
            </div>
        </div>
    @endforeach
</div>