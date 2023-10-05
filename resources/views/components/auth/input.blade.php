<div class="flex flex-col mt-5">
    <label for="{{ $id }}" class="text-base bg-theme-sub text-center py-2 border-x border-t border-black">{{ $label }}</label>
    <input type="{{ $type }}" id="{{ $id }}" name="{{ $id }}" class="text-base block w-full" value="{{ old($id, $db) }}" autocomplete="off">
</div>