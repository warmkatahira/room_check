<form method="GET" action="{{ route('progress_history.index') }}" id="search_form" class="mb-3">
    <div class="flex flex-row">
        <label for="search_customer_code" class="bg-theme-main text-white px-5 py-3 text-sm">荷主名</label>
        <select id="search_customer_code" name="search_customer_code" class="text-sm">
            <option value="all" @if('all' == session('search_customer_code')) selected @endif>全て</option>
            @foreach($customers as $customer)
                <option value="{{ $customer->customer_code }}" @if($customer->customer_code == session('search_customer_code')) selected @endif>{{ $customer->customer_name }}</option>
            @endforeach
        </select>
    </div>
    <input type="hidden" name="search_enter" value="true">
</form>