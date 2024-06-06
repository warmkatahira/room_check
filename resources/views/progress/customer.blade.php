@vite(['resources/js/window_update.js'])

<x-app-layout>
    <!-- 出勤中人数 -->
    <x-progress.current-working-employee :workingInfo="$working_info" />
    <!-- カテゴリ選択 -->
    <x-progress.category-select />
    <!-- 荷主単位 -->
    <x-progress.arr-data :data="$data" />
</x-app-layout>