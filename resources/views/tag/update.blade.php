@vite(['resources/js/tag/tag.js'])

<x-app-layout>
    <x-page-header content="タグマスタ詳細" />
    <!-- バリデーションエラー表示 -->
    <x-validation-error-msg />
    <form method="POST" action="{{ route('tag.update') }}" id="tag_update_form" class="grid grid-cols-12 m-0">
        @csrf
        <x-master.p label="タグID" :db="$tag->tag_id" />
        <x-master.input type="text" name="tag_name" label="タグ名" :db="$tag->tag_name" />
        <x-master.input type="text" name="tag_sort_order" label="タグ並び順" :db="$tag->tag_sort_order" />
        <input type="hidden" name="tag_id" value="{{ $tag->tag_id }}">
        <button type="button" id="tag_update_enter" class="col-start-1 xl:col-start-1 col-span-12 xl:col-span-4 py-3 text-center text-white bg-blue-600 mt-5"><i class="las la-edit la-lg mr-1"></i>更新</button>
    </form>
    <form method="POST" action="{{ route('tag.delete') }}" id="tag_delete_form" class="grid grid-cols-12 m-0">
        @csrf
        <input type="hidden" name="tag_id" value="{{ $tag->tag_id }}">
        <button type="button" id="tag_delete_enter" class="col-start-1 xl:col-start-1 col-span-12 xl:col-span-4 py-3 text-center text-white bg-red-600 mt-5"><i class="las la-trash-alt la-lg mr-1"></i>削除</button>
    </form>
</x-app-layout>