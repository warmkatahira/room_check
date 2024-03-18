@vite(['resources/js/tag/tag.js'])

<x-app-layout>
    <x-page-header content="タグマスタ追加" />
    <!-- バリデーションエラー表示 -->
    <x-validation-error-msg />
    <form method="POST" action="{{ route('tag.create') }}" id="tag_create_form" class="grid grid-cols-12 m-0">
        @csrf
        <x-master.input type="text" name="tag_name" label="タグ名" :db="null" />
        <x-master.input type="text" name="tag_sort_order" label="タグ並び順" :db="null" />
        <button type="button" id="tag_create_enter" class="col-start-1 xl:col-start-1 col-span-12 xl:col-span-4 py-3 text-center text-white bg-blue-600 mt-5"><i class="las la-plus-square la-lg mr-1"></i>追加</button>
    </form>
</x-app-layout>