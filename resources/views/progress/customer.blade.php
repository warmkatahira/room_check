@vite(['resources/js/window_update.js'])
@vite(['resources/scss/alert_message.scss'])

<x-app-layout>
    <!-- 出勤中人数 -->
    <x-progress.current-working-employee :workingInfo="$working_info" />
    <!-- カテゴリ選択 -->
    <x-progress.category-select :bases="$bases" />
    <!-- 荷主単位 -->
    <x-progress.arr-data :data="$data" />
</x-app-layout>