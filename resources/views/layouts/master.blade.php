<!doctype html>
<html lang="RU">
<head>
    @include('components.head')
    @yield('head')
</head>
<body>
<header class="header">
    @include('components.header')
</header>
<main class="main">
    @yield('content')
</main>
<footer class="footer">
    @include('components.footer')
</footer>
</body>
@include('components.footer-scripts')
</html>
