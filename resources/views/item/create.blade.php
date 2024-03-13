@vite(['resources/js/item/item.js'])

<x-app-layout>
    <x-page-header content="項目マスタ追加" />
    <!-- バリデーションエラー表示 -->
    <x-validation-error-msg />
    <form method="POST" action="{{ route('item.create') }}" id="item_create_form" class="grid grid-cols-12 m-0">
        @csrf
        <x-master.input type="text" name="item_code" label="項目コード" :db="null" />
        <x-master.input type="text" name="item_name" label="項目名" :db="null" />
        <x-master.input type="text" name="item_unit" label="項目単位" :db="null" />
        <x-master.input type="text" name="item_sort_order" label="項目並び順" :db="null" />
        <button type="button" id="item_create_enter" class="col-start-1 xl:col-start-1 col-span-12 xl:col-span-4 py-3 text-center text-white bg-blue-600 mt-5"><i class="las la-plus-square la-lg mr-1"></i>追加</button>
    </form>
</x-app-layout>