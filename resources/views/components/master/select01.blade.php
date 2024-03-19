<div class="col-start-1 xl:col-start-1 col-span-12 xl:col-span-4 grid grid-cols-12 mb-2">
    <p class="col-span-12 xl:col-span-4 py-2 text-sm text-center text-white bg-theme-main">{{ $label }}</p>
    <select name="{{ $name }}" class="col-span-12 xl:col-span-8 py-2 text-sm border-none">
        <option value="0" @if(0 == $db) selected @endif>無効</option>
        <option value="1" @if(1 == $db) selected @endif>有効</option>
    </select>
</div>