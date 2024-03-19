<x-app-layout>
    <x-page-header content="権限管理" />
    <div class="grid grid-cols-12 my-5">
        <a href="{{ route('role.create') }}" class="col-span-12 xl:col-span-1 py-3 text-center text-white text-sm bg-blue-600"><i class="las la-plus-square la-lg mr-1"></i>権限追加</a>
    </div>
    <div class="">
        <table class="text-xs block whitespace-nowrap">
            <thead>
                <tr class="text-center text-white bg-gray-600 sticky top-0">
                    <th class="font-thin py-3 px-2">権限名</th>
                    <th class="font-thin py-3 px-2">マスタ操作</th>
                    <th class="font-thin py-3 px-2">管理操作</th>
                    <th class="font-thin py-3 px-2">設定ユーザー数</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($roles as $role)
                    <tr class="text-left hover:bg-theme-sub cursor-default">
                        <td class="py-1 px-2 border">
                            <a href="{{ route('role.update_index', ['role_id' => $role->role_id]) }}" class="text-blue-600">{{ $role->role_name }}</a>
                        </td>
                        <td class="py-1 px-2 border text-center">{{ $role->master_operation_is_available ? '有効' : '無効' }}</td>
                        <td class="py-1 px-2 border text-center">{{ $role->management_operation_is_available ? '有効' : '無効' }}</td>
                        <td class="py-1 px-2 border text-right">{{ $role->users->count() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>