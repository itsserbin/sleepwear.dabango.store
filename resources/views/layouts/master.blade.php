<!doctype html>
<html lang="RU">
<head prefix=
"og: http://ogp.me/ns#
fb: http://ogp.me/ns/fb#
product: http://ogp.me/ns/product#">
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
    <div class="wrapper">
        <button onclick="topFunction()" id="myBtn" class="arrow-to-top">
            <span class="icon-arrow-up2"></span>
        </button>
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
    </div>
    <script>
        mybutton = document.getElementById("myBtn");

        window.onscroll = function() {scrollFunction()};

        function scrollFunction() {
          if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    function topFunction() {
      document.body.scrollTop = 0;
      document.documentElement.scrollTop = 0;
  }
</script>
<script src="https://unpkg.com/smoothscroll-anchor-polyfill"></script>
@include('components.footer-scripts')
</body>
</html>