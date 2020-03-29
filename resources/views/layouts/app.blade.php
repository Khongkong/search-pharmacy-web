<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" 
            integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <script src="{{ asset('js/app.js') }}"></script>
        <title>{{ config('app.name', '全台藥局口罩資訊') }}</title>
    </head>
    <body>
        <div class="container">
            @include('inc.navbar')
            @yield('content')
            @include('pages.result')
        </div>
    </body>
</html>
