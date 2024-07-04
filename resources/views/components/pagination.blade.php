<!-- ページネーション -->
<div class="mb-1">
    @if($pages)
        <div class="">
            {{ $pages->appends(request()->input())->links() }}
        </div>
    @endif
</div>