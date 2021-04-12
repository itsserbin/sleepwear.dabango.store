<meta charset="UTF-8">
<meta name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>@yield('title')</title>
<meta name="description" content="@yield('description')">
@yield('head')
<link rel="stylesheet" href="{{asset('css/app.css')}}">
<meta name="facebook-domain-verification" content="iwcc5klugzvznucuiqc4rxje76jo41"/>

<meta property="og:locale" content="ru_RU">
<meta property="og:type" content="og:product">
<meta property="og:title" content="@yield('title')">
<meta property="og:image" content="{{asset('storage/img/content/logo.png')}}">
<meta property="og:description" content="@yield('description')">
<meta property="og:url" content="{{url()->current()}}">
<meta property="og:site_name" content="YouBrand">
@if(Route::is('product') )
    <meta property="product:price:amount" content="@if($product->sale_cost){{$product->sale_cost}}@else{{$product->cost}}@endif"/>
    <meta property="product:price:currency" content="UAH"/>
@endif

<!-- Facebook Pixel Code -->
<script>
    !function (f, b, e, v, n, t, s) {
        if (f.fbq) return;
        n = f.fbq = function () {
            n.callMethod ?
                n.callMethod.apply(n, arguments) : n.queue.push(arguments)
        };
        if (!f._fbq) f._fbq = n;
        n.push = n;
        n.loaded = !0;
        n.version = '2.0';
        n.queue = [];
        t = b.createElement(e);
        t.async = !0;
        t.src = v;
        s = b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t, s)
    }(window, document, 'script',
        'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '550347372615542');
    fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
               src="https://www.facebook.com/tr?id=550347372615542&ev=PageView&noscript=1"
    /></noscript>
<!-- End Facebook Pixel Code -->
