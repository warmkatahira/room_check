<x-app-layout>
    <x-page-header content="荷主マスタ" />
    <div class="grid grid-cols-12 my-5">
        <a href="{{ route('customer.create') }}" class="col-span-12 xl:col-span-1 py-3 text-center text-white text-sm bg-blue-600"><i class="las la-plus-square la-lg mr-1"></i>荷主追加</a>
    </div>
    <div class="grid grid-cols-12 gap-2">
        @foreach($customers as $customer)
            <a href="{{ route('customer.update_index', ['customer_code' => $customer->customer_code]) }}" class="col-span-12 xl:col-span-3 border border-theme-main">
                <div class="grid grid-cols-12 border-b border-theme-main">
                    <p class="col-span-4 py-2 text-sm text-center bg-theme-sub">荷主名</p>
                    <p class="col-span-8 py-2 text-sm text-center bg-theme-sub">{{ $customer->customer_name }}</p>
                </div>
                <div class="grid grid-cols-12 border-b border-theme-main">
                    <p class="col-span-4 py-2 text-sm text-center bg-theme-sub">荷主コード</p>
                    <p class="col-span-8 py-2 text-sm text-center bg-theme-sub">{{ $customer->customer_code }}</p>
                </div>
                <div class="grid grid-cols-12">
                    <p class="col-span-4 py-2 text-sm text-center bg-theme-sub">営業所名</p>
                    <p class="col-span-8 py-2 text-sm text-center bg-theme-sub">{{ $customer->base->base_name }}</p>
                </div>
            </a>
        @endforeach
    </div>
</x-app-layout>