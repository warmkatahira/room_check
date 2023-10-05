@vite(['resources/scss/navigation.scss'])

<nav id="navigation">
    <a href="{{ route('progress.customer') }}" class="logo">ミエル</a>
    <ul class="links flex">
        <li class="dropdown"><a href="{{ route('progress.customer') }}" class="trigger-drop">進捗</a></li>
        <li class="dropdown"><a href="#" class="trigger-drop">商品</a>
            <ul class="drop">
                <li><a href="">商品マスタ</a></li>
                <li><a href="">商品アップロード</a></li>
            </ul>
        </li>
        <li class="dropdown"><a href="#" class="trigger-drop">在庫</a>
            <ul class="drop">
                <li><a href="">在庫</a></li>
                <li><a href="">入庫予定</a></li>
                <li><a href="">入庫</a></li>
                <li><a href="">出庫</a></li>
                <li><a href="">在庫操作履歴</a></li>
            </ul>
        </li>
    </ul>
    <form method="POST" action="{{ route('logout') }}" class="m-0 logout">
        @csrf
        <button type="submit" class="">ログアウト</button>
    </form>
</nav>