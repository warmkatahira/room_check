@vite(['resources/js/customer/customer.js'])

<x-app-layout>
    <x-page-header content="荷主マスタ詳細" />
    <!-- バリデーションエラー表示 -->
    <x-validation-error-msg />
    <form method="POST" action="{{ route('customer.update') }}" id="customer_update_form" class="grid grid-cols-12 m-0">
        @csrf
        <x-master.p label="荷主コード" :db="$customer->customer_code" />
        <x-master.input type="text" name="customer_name" label="荷主名" :db="$customer->customer_name" />
        <x-master.select name="base_id" label="営業所名" :forValue="$bases" forText="base_name" :db="$customer->base_id" />
        <input type="hidden" name="customer_code" value="{{ $customer->customer_code }}">
        <button type="button" id="customer_update_enter" class="col-start-1 xl:col-start-1 col-span-12 xl:col-span-4 py-3 text-center text-white bg-blue-600 mt-5"><i class="las la-edit la-lg mr-1"></i>更新</button>
    </form>
    <form method="POST" action="{{ route('customer.delete') }}" id="customer_delete_form" class="grid grid-cols-12 m-0">
        @csrf
        <input type="hidden" name="customer_code" value="{{ $customer->customer_code }}">
        <button type="button" id="customer_delete_enter" class="col-start-1 xl:col-start-1 col-span-12 xl:col-span-4 py-3 text-center text-white bg-red-600 mt-5"><i class="las la-trash-alt la-lg mr-1"></i>削除</button>
    </form>
</x-app-layout>