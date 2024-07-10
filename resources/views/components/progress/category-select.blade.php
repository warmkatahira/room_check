@vite(['resources/js/progress/category_select.js'])

<div class="grid grid-cols-12 gap-2 mb-5">
    <a href="{{ route('progress.customer') }}" class="category_select col-span-4 xl:col-span-1 text-center py-2 px-5 bg-theme-sub">荷主</a>
    <a href="{{ route('progress.base') }}" class="category_select col-span-4 xl:col-span-1 text-center py-2 px-5 bg-theme-sub">拠点</a>
    <a href="{{ route('progress.tag') }}" class="category_select col-span-4 xl:col-span-1 text-center py-2 px-5 bg-theme-sub">タグ</a>
    @if($bases)
        <form method="GET" action="{{ route('progress.customer') }}" class="col-span-12 xl:col-span-2 col-start-1 xl:col-start-11 m-0" id="base_select_form">
            <select id="search_base_id" name="search_base_id" class="text-sm w-full">
                <option value="">全て</option>
                @foreach($bases as $base)
                    <option value="{{ $base->base_id }}" @if($base->base_id == session('search_base_id')) selected @endif>{{ $base->base_name }}</option>
                @endforeach
            </select>
            <input type="hidden" name="base_select_enter" value="true">
        </form>
    @endif
</div>