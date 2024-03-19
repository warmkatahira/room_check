@vite(['resources/js/role/role.js'])

<x-app-layout>
    <x-page-header content="権限詳細" />
    <!-- バリデーションエラー表示 -->
    <x-validation-error-msg />
    <form method="POST" action="{{ route('role.update') }}" id="role_update_form" class="grid grid-cols-12 m-0">
        @csrf
        <x-master.input type="text" name="role_name" label="権限名" :db="$role->role_name" />
        <x-master.select01 name="master_operation_is_available" label="マスタ操作" :db="$role->master_operation_is_available" />
        <x-master.select01 name="management_operation_is_available" label="権限操作" :db="$role->management_operation_is_available" />
        <input type="hidden" name="role_id" value="{{ $role->role_id }}">
        <button type="button" id="role_update_enter" class="col-start-1 xl:col-start-1 col-span-12 xl:col-span-4 py-3 text-center text-white bg-blue-600 mt-5"><i class="las la-edit la-lg mr-1"></i>更新</button>
    </form>
    <form method="POST" action="{{ route('role.delete') }}" id="role_delete_form" class="grid grid-cols-12 m-0">
        @csrf
        <input type="hidden" name="role_id" value="{{ $role->role_id }}">
        <button type="button" id="role_delete_enter" class="col-start-1 xl:col-start-1 col-span-12 xl:col-span-4 py-3 text-center text-white bg-red-600 mt-5"><i class="las la-trash-alt la-lg mr-1"></i>削除</button>
    </form>
</x-app-layout>