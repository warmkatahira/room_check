<x-guest-layout>
    <!-- バリデーションエラー -->
    <x-validation-error-msg />
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <!-- ユーザーID -->
        <x-auth.input id="user_id" label="ユーザーID" type="text" :db="null" />
        <!-- パスワード -->
        <x-auth.input id="password" label="パスワード" type="password" :db="null" />
        <div class="flex mt-4">
            <button type="submit" class="text-2xl bg-theme-main text-white text-center py-5 w-full"><i class="las la-sign-in-alt mr-2 la-lg"></i>ログイン</button>
        </div>
    </form>
</x-guest-layout>
