<x-app-layout>
    <!-- カテゴリ選択 -->
    <x-progress.category-select />
    <!-- タグ単位 -->
    <x-progress.arr-data :arr="$tag_progress_arr" />
</x-app-layout>