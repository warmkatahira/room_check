@vite(['resources/js/window_update.js'])

<x-app-layout>
    <!-- 出勤中人数 -->
    <x-progress.current-working-employee :employeeCount="$employee_count" />
    <!-- カテゴリ選択 -->
    <x-progress.category-select />
    <!-- タグ単位 -->
    <x-progress.arr-data :data="$data" />
</x-app-layout>