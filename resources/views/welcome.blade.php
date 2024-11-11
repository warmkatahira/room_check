<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>入退室ログチェック</title>

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

        @vite(['resources/js/file_select.js'])

        <!-- toastr.js -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    </head>
    <body>
        <div class="flex flex-row mt-5 justify-center items-center">
            <p class="text-5xl mt-1.5">入退室ログチェック</p>
            <form method="POST" action="{{ route('log_check.import') }}" id="log_check_form" class="ml-10" enctype="multipart/form-data">
                @csrf
                <div class="select_file">
                    <label class="whitespace-nowrap bg-green-600 text-white inline-block text-center p-5 hover:cursor-pointer">
                        <i class="las la-file-alt la-lg mr-1"></i>ログを選択
                        <input type="file" id="select_file" name="select_file" class="hidden">
                    </label>
                </div>
            </form>
        </div>
        @if(count($abnormal_logs) > 0)
            <div class="flex mt-10 justify-center items-center">
                <table class="text-sm block">
                    <thead>
                        <tr class="text-left text-white bg-gray-600 whitespace-nowrap sticky top-0">
                            <th class="font-thin py-1 px-2">日時</th>
                            <th class="font-thin py-1 px-2">ユーザー名</th>
                            <th class="font-thin py-1 px-2">異常</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach($abnormal_logs as $abnormal_log)
                            <tr class="text-left hover:bg-green-200 cursor-default whitespace-nowrap">
                                <td class="py-1 px-2 border">{{ CarbonImmutable::parse($abnormal_log->access_date)->isoFormat('Y年MM月DD日(ddd) HH時mm分ss秒') }}</td>
                                <td class="py-1 px-2 border">{{ $abnormal_log->access_user_name }}</td>
                                <td class="py-1 px-2 border">{{ $abnormal_log->abnormal_note }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </body>
</html>
