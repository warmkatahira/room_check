<x-app-layout>
    <x-page-header content="ユーザー管理" />
    <div class="">
        <table class="text-xs block whitespace-nowrap">
            <thead>
                <tr class="text-center text-white bg-gray-600 sticky top-0">
                    <th class="font-thin py-3 px-2">ユーザーID</th>
                    <th class="font-thin py-3 px-2">ユーザー名</th>
                    <th class="font-thin py-3 px-2">権限</th>
                    <th class="font-thin py-3 px-2">ステータス</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($users as $user)
                    <tr class="text-left hover:bg-theme-sub cursor-default">
                        <td class="py-1 px-2 border">
                            <a href="{{ route('user.update_index', ['user_id' => $user->user_id]) }}" class="text-blue-600">{{ $user->user_id }}</a>
                        </td>
                        <td class="py-1 px-2 border">{{ $user->user_name }}</td>
                        <td class="py-1 px-2 border">{{ $user->role->role_name }}</td>
                        <td class="py-1 px-2 border text-center">{{ $user->status ? '有効' : '無効' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>