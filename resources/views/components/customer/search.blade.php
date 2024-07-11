<form method="GET" action="{{ route('customer.index') }}" id="search_form" class="mb-3">
    <!-- 拠点名 -->
    <div class="flex flex-row">
        <label for="search_base_id" class="bg-theme-main text-white px-5 py-3 text-sm">拠点名</label>
        <select id="search_base_id" name="search_base_id" class="search_enter text-sm">
            <option value="">全て</option>
            @foreach($bases as $base)
                <option value="{{ $base->base_id }}" @if($base->base_id == session('search_base_id')) selected @endif>{{ $base->base_name }}</option>
            @endforeach
        </select>
    </div>
    <input type="hidden" name="search_enter" value="true">
</form>