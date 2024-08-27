<div id="comment_modal" class="fixed hidden z-40 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-20">
    <div class="relative top-20 mx-auto shadow-lg bg-theme-gray py-5 px-4">
        <div class="flex flex-row">
            <p class="text-2xl">コメント</p>
        </div>
        <div class="flex flex-row items-start mt-2">
            <input type="text" id="comment" name="comment" class="w-96 text-sm" value="" autocomplete="off">
            <input type="hidden" id="customer_code" name="customer_code" value="">
        </div>
        <div class="flex flex-row mt-5">
            <button type="button" id="comment_update_enter" class="py-2 border border-blue-500 bg-blue-100 text-blue-500 w-40">更新</button>
            <button type="button" id="comment_modal_close" class="comment_modal_close ml-10 py-2 border border-red-500 bg-red-100 text-red-500 w-40">閉じる</button>
        </div>
    </div>
</div>