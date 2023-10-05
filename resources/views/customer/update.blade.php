@vite(['resources/js/customer/customer_update.js'])

<x-app-layout>
    <form method="POST" action="{{ route('customer.update') }}" id="customer_update_form" class="grid grid-cols-12 m-0">
        @csrf
        <div class="col-start-1 xl:col-start-1 col-span-12 xl:col-span-4 grid grid-cols-12">
            <p class="col-span-12 xl:col-span-4 py-2 text-sm text-center text-white bg-theme-main">荷主コード</p>
            <p class="col-span-12 xl:col-span-8 py-2 text-sm border-none bg-white pl-3">{{ $customer->customer_code }}</p>
        </div>
        <div class="col-start-1 xl:col-start-1 col-span-12 xl:col-span-4 grid grid-cols-12 mt-3">
            <p class="col-span-12 xl:col-span-4 py-2 text-sm text-center text-white bg-theme-main">荷主名</p>
            <input type="text" name="customer_name" class="col-span-12 xl:col-span-8 py-2 text-sm border-none" value="{{ $customer->customer_name }}" autocomplete="off">
        </div>
        <div class="col-start-1 xl:col-start-1 col-span-12 xl:col-span-4 grid grid-cols-12 mt-3">
            <p class="col-span-12 xl:col-span-4 py-2 text-sm text-center text-white bg-theme-main">営業所名</p>
            <select name="base_id" class="col-span-12 xl:col-span-8 py-2 text-sm border-none">
                @foreach($bases as $base)
                    <option value="{{ $base->base_id }}" @if($base->base_id == $customer->base_id) selected @endif>{{ $base->base_name }}</option>
                @endforeach
            </select>
        </div>
        <input type="hidden" name="customer_code" value="{{ $customer->customer_code }}">
        <button type="button" id="customer_update_enter" class="col-start-1 xl:col-start-1 col-span-12 xl:col-span-4 py-3 text-center text-white bg-blue-600 mt-5"><i class="las la-edit la-lg mr-1"></i>更新</button>
    </form>
    <form method="POST" action="{{ route('customer.delete') }}" id="customer_delete_form" class="grid grid-cols-12 m-0">
        @csrf
        <input type="hidden" name="customer_code" value="{{ $customer->customer_code }}">
        <button type="button" id="customer_delete_enter" class="col-start-1 xl:col-start-1 col-span-12 xl:col-span-4 py-3 text-center text-white bg-red-600 mt-5"><i class="las la-trash-alt la-lg mr-1"></i>削除</button>
    </form>
</x-app-layout>