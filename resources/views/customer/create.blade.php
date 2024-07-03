@vite(['resources/js/customer/customer.js'])

<x-app-layout>
    <x-page-header content="荷主マスタ追加" />
    <!-- バリデーションエラー表示 -->
    <x-validation-error-msg />
    <form method="POST" action="{{ route('customer.create') }}" id="customer_create_form" class="grid grid-cols-12 m-0">
        @csrf
        <x-master.input type="text" name="customer_code" label="荷主コード" :db="null" />
        <x-master.input type="text" name="customer_category" label="荷主分類" :db="null" />
        <x-master.input type="text" name="customer_name" label="荷主名" :db="null" />
        <x-master.select name="base_id" label="拠点名" :forValue="$bases" forText="base_name" :db="null" />
        <button type="button" id="customer_create_enter" class="col-start-1 xl:col-start-1 col-span-12 xl:col-span-4 py-3 text-center text-white bg-blue-600 mt-5"><i class="las la-plus-square la-lg mr-1"></i>追加</button>
    </form>
</x-app-layout>