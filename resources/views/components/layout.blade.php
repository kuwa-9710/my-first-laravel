<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="{{ mix('/js/app.js') }}"></script>
    {{-- $titleの部分をpropsという。これは外部から変数を受け取ることができる。 --}}
    <title>{{ $title ?? 'Tweet Application.' }}</title>
    {{-- pushと対になって動作する --}}
    @stack('css')
</head>
<body class="bg-gray-50">
    {{ $slot }}
</body>
</html>
</body>
</html>