<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

</head>
<body>
    @include('user.layouts.header')
    @include('user.layouts.menu')


    <div class="container">
    @yield('content')
    </div>

    @include('user.layouts.footer')
</body>
</html>
