<x-app-layout>
    <!-- カテゴリ選択 -->
    <x-progress.category-select />
    <!-- 営業所単位 -->
    <x-progress.arr-data :arr="$base_progress_arr" />
</x-app-layout>