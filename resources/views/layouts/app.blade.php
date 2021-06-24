<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{asset('admin/admin.css') }}">
    <script type="text/javascript"
            src="https://cdn.tiny.cloud/1/ufqphs7puyg4ij1mc3c61o7isu5mxekk5x9yygffpdo89ava/tinymce/5/tinymce.min.js"
            referrerpolicy="origin"></script>
</head>
<body>
<div id="app">
    @include('admin.components.navigation')
    <header class="bg-white shadow">
        <h1 class="max-w-7xl mx-auto p-4">
            @yield('header')
        </h1>
    </header>

    <main class="py-4">
        @yield('content')
    </main>

</div>

<script src="{{asset('admin/admin.js') }}"></script>
<script>
    tinymce.init({
        selector: '.editor',
        height: 350,
        plugins: 'code | table',
    });
</script>
</body>
</html>
