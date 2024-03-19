@vite(['resources/js/role/role.js'])

<x-app-layout>
    <x-page-header content="権限追加" />
    <!-- バリデーションエラー表示 -->
    <x-validation-error-msg />
    <form method="POST" action="{{ route('role.create') }}" id="role_create_form" class="grid grid-cols-12 m-0">
        @csrf
        <x-master.input type="text" name="role_name" label="権限名" :db="null" />
        <x-master.select01 name="master_operation_is_available" label="マスタ操作" :db="null" />
        <x-master.select01 name="management_operation_is_available" label="権限操作" :db="null" />
        <button type="button" id="role_create_enter" class="col-start-1 xl:col-start-1 col-span-12 xl:col-span-4 py-3 text-center text-white bg-blue-600 mt-5"><i class="las la-plus-square la-lg mr-1"></i>追加</button>
    </form>
</x-app-layout>