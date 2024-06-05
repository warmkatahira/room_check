@vite(['resources/js/window_update.js'])

<x-app-layout>
    <!-- カテゴリ選択 -->
    <x-progress.category-select />
    <!-- 出勤中人数 -->
    <x-progress.current-working-employee :employeeCount="$employee_count" />
    <!-- 荷主単位 -->
    <x-progress.arr-data :data="$data" />
</x-app-layout>