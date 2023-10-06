@vite(['resources/js/customer/customer.js'])

<x-app-layout>
    <x-page-header content="荷主マスタ追加" />
    <!-- バリデーションエラー表示 -->
    <x-validation-error-msg />
    <form method="POST" action="{{ route('customer.create') }}" id="customer_create_form" class="grid grid-cols-12 m-0">
        @csrf
        <div class="col-start-1 xl:col-start-1 col-span-12 xl:col-span-4 grid grid-cols-12">
            <p class="col-span-12 xl:col-span-4 py-2 text-sm text-center text-white bg-theme-main">荷主コード</p>
            <input type="text" name="customer_code" class="col-span-12 xl:col-span-8 py-2 text-sm border-none" autocomplete="off">
        </div>
        <div class="col-start-1 xl:col-start-1 col-span-12 xl:col-span-4 grid grid-cols-12 mt-3">
            <p class="col-span-12 xl:col-span-4 py-2 text-sm text-center text-white bg-theme-main">荷主名</p>
            <input type="text" name="customer_name" class="col-span-12 xl:col-span-8 py-2 text-sm border-none"" autocomplete="off">
        </div>
        <div class="col-start-1 xl:col-start-1 col-span-12 xl:col-span-4 grid grid-cols-12 mt-3">
            <p class="col-span-12 xl:col-span-4 py-2 text-sm text-center text-white bg-theme-main">営業所名</p>
            <select name="base_id" class="col-span-12 xl:col-span-8 py-2 text-sm border-none">
                @foreach($bases as $base)
                    <option value="{{ $base->base_id }}">{{ $base->base_name }}</option>
                @endforeach
            </select>
        </div>
        <button type="button" id="customer_create_enter" class="col-start-1 xl:col-start-1 col-span-12 xl:col-span-4 py-3 text-center text-white bg-blue-600 mt-5"><i class="las la-plus-square la-lg mr-1"></i>追加</button>
    </form>
</x-app-layout>