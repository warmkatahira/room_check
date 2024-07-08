<form method="GET" action="{{ route('version_mgt.index') }}" id="search_form" class="mb-3">
    <!-- 荷主名 -->
    <div class="flex flex-row">
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
    </div>
    <input type="hidden" name="search_enter" value="true">
</form>