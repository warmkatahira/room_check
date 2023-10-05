<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ミエル</title>

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- favicon -->
        <link rel="shortcut icon" href="{{ asset('image/favicon.svg') }}">

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/scss/theme.scss'])

        <!-- LINE AWESOME -->
        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Marko+One&family=Zen+Maru+Gothic:wght@500&display=swap" rel="stylesheet">

        <!-- Lordicon -->
        <script src="https://cdn.lordicon.com/pzdvqjsp.js"></script>

        <!-- toastr.js -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    </head>
    <body>
        <!-- アラート表示 -->
        <x-alert/>
        <div class="mt-3">
            <p class="text-2xl text-center text-theme-main">業務進捗確認サービス</p>
            <p class="text-7xl text-center text-theme-main">ミエル</p>
        </div>
        <div class="flex justify-center mt-10">
            @auth
                <a href="{{ route('top.index') }}" class="text-5xl bg-theme-main text-white py-20 px-36"><i class="las la-meh-rolling-eyes mr-2 la-lg"></i>トップ</a>
            @else
                <a href="{{ route('login') }}" class="text-5xl bg-theme-main text-white py-20 px-36"><i class="las la-sign-in-alt mr-2 la-lg"></i>ログイン</a>
            @endauth
        </div>
    </body>
</html>
