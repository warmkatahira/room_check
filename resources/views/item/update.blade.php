@vite(['resources/js/item/item.js'])

<x-app-layout>
    <x-page-header content="項目マスタ詳細" />
    <!-- バリデーションエラー表示 -->
    <x-validation-error-msg />
    <form method="POST" action="{{ route('item.update') }}" id="item_update_form" class="grid grid-cols-12 m-0">
        @csrf
        <x-master.p label="項目コード" :db="$item->item_code" />
        <x-master.input type="text" name="item_name" label="項目名" :db="$item->item_name" />
        <x-master.input type="text" name="item_unit" label="項目単位" :db="$item->item_unit" />
        <x-master.input type="text" name="item_sort_order" label="項目並び順" :db="$item->item_sort_order" />
        <input type="hidden" name="item_code" value="{{ $item->item_code }}">
        <x-master.select01 name="is_progress_history_add" label="進捗履歴追加" :db="$item->is_progress_history_add" />
        <button type="button" id="item_update_enter" class="col-start-1 xl:col-start-1 col-span-12 xl:col-span-4 py-3 text-center text-white bg-blue-600 mt-5"><i class="las la-edit la-lg mr-1"></i>更新</button>
    </form>
    <form method="POST" action="{{ route('item.delete') }}" id="item_delete_form" class="grid grid-cols-12 m-0">
        @csrf
        <input type="hidden" name="item_code" value="{{ $item->item_code }}">
        <button type="button" id="item_delete_enter" class="col-start-1 xl:col-start-1 col-span-12 xl:col-span-4 py-3 text-center text-white bg-red-600 mt-5"><i class="las la-trash-alt la-lg mr-1"></i>削除</button>
    </form>
</x-app-layout>