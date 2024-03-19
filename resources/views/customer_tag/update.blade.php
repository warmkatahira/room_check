@vite(['resources/js/customer_tag/customer_tag.js'])

<x-app-layout>
    <x-page-header content="荷主タグマスタ詳細" />
    <!-- バリデーションエラー表示 -->
    <x-validation-error-msg />
    <form method="POST" action="{{ route('customer_tag.update') }}" id="customer_tag_update_form" class="grid grid-cols-12 m-0">
        @csrf
        <x-master.p label="荷主コード" :db="$customer->customer_code" />
        <x-master.p label="荷主名" :db="$customer->customer_name" />
        <x-master.p label="拠点" :db="$customer->base->base_name" />
        <div class="col-start-1 xl:col-start-1 col-span-12 xl:col-span-4 grid grid-cols-12 mb-2">
            <p class="col-span-12 xl:col-span-4 py-2 text-sm text-center text-white bg-theme-main">タグ一覧</p>
            <select id="select_tag" class="col-span-12 xl:col-span-6 py-2 text-sm border-none">
                @foreach($tags as $tag)
                    <option value="{{ $tag->tag_id }}">{{ $tag->tag_name }}</option>
                @endforeach
            </select>
            <button type="button" id="tag_add" class="bg-theme-main text-center text-sm text-white col-span-12 xl:col-span-2">追加</button>
        </div>
        <div class="col-start-1 xl:col-start-1 col-span-12 xl:col-span-4 grid grid-cols-12 bg-white mb-2">
            <p class="col-span-12 xl:col-span-4 py-2 text-sm text-center text-white bg-theme-main">設定タグ</p>
            <div id="setting_tag_div" class="col-span-12 xl:col-span-8 grid grid-cols-12 gap-x-4 gap-y-2 p-2">
                @foreach($customer->customer_tags as $customer_tag)
                    <input type="text" id="{{ $customer_tag->tag_id }}" name="tag_id[{{ $customer_tag->tag_id }}]" class="tag_delete text-xs bg-theme-main text-white border-none col-span-4 text-center rounded-md cursor-pointer" data-tag_id="{{ $customer_tag->tag_id }}" value="{{ $customer_tag->tag_name }}" readonly />
                @endforeach
            </div>
        </div>
        <input type="hidden" name="customer_code" value="{{ $customer->customer_code }}">
        <button type="button" id="customer_tag_update_enter" class="col-start-1 xl:col-start-1 col-span-12 xl:col-span-4 py-3 text-center text-white bg-blue-600 mt-5"><i class="las la-edit la-lg mr-1"></i>更新</button>
    </form>
</x-app-layout>