<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{  $title }}</title>

    <link rel="stylesheet" href="/assets/app/bootstrap.min.css">
    @yield('style')

</head>
<body>

@yield('content')

<script src="/assets/app/jquery-3.3.1.min.js"></script>
<script src="/assets/app/bootstrap.min.js"></script>
@yield('script')

</body>
</html>