<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="{{asset('admin/admin.css') }}">
    <script src="{{asset('admin/admin.js') }}"></script>
</head>
<body>
<div class="container">
    <div class="row align-items-center" style="height: 100vh">
        <div class="col-12">
            @include('components.flash-message')
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
