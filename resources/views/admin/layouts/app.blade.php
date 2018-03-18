<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', '后台管理')</title>

    <!-- styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body>

<div id="app" class="{{ route_class() }}-page">

    @include('admin.layouts._header')

    <div class="container-fluid">
        <div class="content">

            @include('admin.layouts._message')
            @yield('content')

        </div>

    </div>

    @include('admin.layouts._footer')
</div>

<!-- scripts -->
<script src="{{ asset('js/app.js') }}"></script>
@yield('scripts')
</body>
</html>