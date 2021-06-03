<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <script src="//cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>

    <link rel="stylesheet" href="{{asset('admin/admin.css') }}">
    <script src="{{asset('admin/admin.js') }}"></script>
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-light h-100">
    @include('admin.components.navigation')
    <header class="bg-white shadow">
        <h1 class="max-w-7xl mx-auto p-4">
            @yield('header')
        </h1>
    </header>

    <!-- Page Content -->
    <main class="p-3 p-md-5 m-2 m-md-5 bg-white rounded-3">
        @include('components.flash-message')
        @yield('content')
    </main>
</div>
</body>
<script src="{{ asset('js/app.js') }}" defer></script>
</html>
