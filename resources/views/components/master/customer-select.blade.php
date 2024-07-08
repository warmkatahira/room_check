<div class="col-start-1 xl:col-start-1 col-span-12 xl:col-span-4 grid grid-cols-12 mb-2">
    <p class="col-span-12 xl:col-span-4 py-2 text-sm text-center text-white bg-theme-main">荷主名</p>
    <select id="customer_code" name="customer_code" class="col-span-12 xl:col-span-8 py-2 text-sm border-none">
        <option value=""></option>
        @foreach($bases as $base)
            @if($base->customers->count() > 0)
                <optgroup label="{{ $base->base_name }}">
                    @foreach($base->customers as $customer)
                        <option value="{{ $customer->customer_code }}" @if($customer->customer_code == $db) selected @endif>{{ $customer->customer_name }}</option>
                    @endforeach
                </optgroup>
            @endif
        @endforeach
    </select>
</div>