@vite(['resources/js/user/user.js'])

<x-app-layout>
    <x-page-header content="ユーザー詳細" />
    <!-- バリデーションエラー表示 -->
    <x-validation-error-msg />
    <form method="POST" action="{{ route('user.update') }}" id="user_update_form" class="grid grid-cols-12 m-0">
        @csrf
        <x-master.p label="ユーザーID" :db="$user->user_id" />
        <x-master.p label="ユーザー名" :db="$user->user_name" />
        <x-master.select name="role_id" label="権限" :forValue="$roles" forText="role_name" :db="$user->role_id" />
        <div class="col-start-1 xl:col-start-1 col-span-12 xl:col-span-4 grid grid-cols-12 mb-2">
            <p class="col-span-12 xl:col-span-4 py-2 text-sm text-center text-white bg-theme-main">ステータス</p>
            <select name="status" class="col-span-12 xl:col-span-8 py-2 text-sm border-none">
                <option value="0" @if(0 == $user->status) selected @endif>無効</option>
                <option value="1" @if(1 == $user->status) selected @endif>有効</option>
            </select>
        </div>
        <input type="hidden" name="user_id" value="{{ $user->user_id }}">
        <button type="button" id="user_update_enter" class="col-start-1 xl:col-start-1 col-span-12 xl:col-span-4 py-3 text-center text-white bg-blue-600 mt-5"><i class="las la-edit la-lg mr-1"></i>更新</button>
    </form>
</x-app-layout>