<!doctype html>
<html lang="RU">
<head>
@include('components.head')
<!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-W4XTK84');</script>
    <!-- End Google Tag Manager -->
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W4XTK84"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
<a href="#top" class="arrow-to-top">
    <span class="icon-arrow-up2"></span>
</a>
<header class="header">
    @include('components.header')
</header>
<main class="main">
    @include('components.flash-message')
    @yield('content')
</main>
<footer class="footer">
    @include('components.footer')
</footer>
</body>
@include('components.footer-scripts')
</html>
