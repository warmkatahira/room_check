<div class="col-start-1 xl:col-start-1 col-span-12 xl:col-span-4 grid grid-cols-12 mb-2">
    <p class="col-span-12 xl:col-span-4 py-2 text-sm text-center text-white bg-theme-main">項目名</p>
    <select name="item_code" class="col-span-12 xl:col-span-8 py-2 text-sm border-none">
        @foreach($items as $item)
            <option value="{{ $item->item_code }}"@if($item->item_code == $db) selected @endif>{{ $item->item_name.'('.$item->item_unit.')' }}</option>
        @endforeach
    </select>
</div>