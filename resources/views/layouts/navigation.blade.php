@vite(['resources/scss/navigation.scss', 'resources/scss/navigation_hamburger.scss'])

<nav id="navigation">
    <a href="{{ route('progress.customer') }}" class="logo">ミエル</a>
    <ul class="links flex">
        <li class="dropdown"><a href="{{ route('progress.customer') }}" class="trigger-drop">進捗</a></li>
        <li class="dropdown"><a href="#" class="trigger-drop">マスタ</a>
            <ul class="drop">
                <li><a href="{{ route('customer.index') }}">荷主マスタ</a></li>
                <li><a href="{{ route('item.index') }}">項目マスタ</a></li>
                <li><a href="{{ route('tag.index') }}">タグマスタ</a></li>
                <li><a href="{{ route('customer_tag.index') }}">荷主タグマスタ</a></li>
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

<header id="hamburger" class="nav-header py-2">
    <div class="grid grid-cols-12">
        <div class="col-span-2">
            <input type="checkbox" class="menu-btn" id="menu-btn">
            <label for="menu-btn" class="menu-icon"><span class="navicon"></span></label>
            <ul class="menu border-b-4 border-white">
                <li><a href="">進捗一覧</a></li>
                <li><a href="">荷主一覧</a></li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <li class=""><a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">ログアウト</a></li>
                </form>
            </ul>
        </div>
        <p class="col-start-3 xl:col-start-3 col-span-5 xl:col-span-8 text-2xl xl:text-5xl text-left xl:text-center text-white mt-2 xl:mt-0">ミエル</p>
        <p class="col-start-9 xl:col-start-11 col-span-4 xl:col-span-2 text-right text-sm xl:text-xl mr-3 mt-4 xl:mt-3">{{ Auth::user()->name }}</p>
    </div>
</header>