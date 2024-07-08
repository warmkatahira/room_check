<form method="GET" action="{{ route('progress_history.index') }}" id="search_form" class="mb-1">
    <div class="flex flex-row">
        <!-- 日付 -->
        <label for="" class="bg-theme-main text-white px-5 py-3 text-sm">日付</label>
        <input type="date" name="search_date_from" class="search_enter date_from text-sm py-0" value="{{ session('search_date_from') }}" autocomplete="off">
        <label class="text-center text-xs px-2 py-3">～</label>
        <input type="date" name="search_date_to" class="search_enter date_to text-sm py-0" value="{{ session('search_date_to') }}" autocomplete="off">
        <!-- 荷主名 -->
        <label for="search_customer_code" class="bg-theme-main text-white px-5 py-3 text-sm">荷主名</label>
        <select id="search_customer_code" name="search_customer_code" class="search_enter text-sm">
            <option value="">全て</option>
            @foreach($bases as $base)
                @if($base->customers->count() > 0)
                    <optgroup label="{{ $base->base_name }}">
                        @foreach($base->customers as $customer)
                            <option value="{{ $customer->customer_code }}" @if($customer->customer_code == session('search_customer_code')) selected @endif>{{ $customer->customer_name }}</option>
                        @endforeach
                    </optgroup>
                @endif
            @endforeach
        </select>
        <!-- 項目名 -->
        <label for="search_item_code" class="bg-theme-main text-white px-5 py-3 text-sm">項目名</label>
        <select id="search_item_code" name="search_item_code" class="search_enter text-sm">
            <option value="">全て</option>
            @foreach($items as $item)
                <option value="{{ $item->item_code }}" @if($item->item_code == session('search_item_code')) selected @endif>{{ $item->item_name.'('.$item->item_unit.')' }}</option>
            @endforeach
        </select>
    </div>
    <input type="hidden" name="search_enter" value="true">
</form>