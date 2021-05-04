<meta charset="UTF-8">
<meta name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<link rel="apple-touch-icon" sizes="57x57" href="{{asset('storage/favicon/apple-icon-57x57.png')}}">
<link rel="apple-touch-icon" sizes="60x60" href="{{asset('storage/favicon/apple-icon-60x60.png')}}">
<link rel="apple-touch-icon" sizes="72x72" href="{{asset('storage/favicon/apple-icon-72x72.png')}}">
<link rel="apple-touch-icon" sizes="76x76" href="{{asset('storage/favicon/apple-icon-76x76.png')}}">
<link rel="apple-touch-icon" sizes="114x114" href="{{asset('storage/favicon/apple-icon-114x114.png')}}">
<link rel="apple-touch-icon" sizes="120x120" href="{{asset('storage/favicon/apple-icon-120x120.png')}}">
<link rel="apple-touch-icon" sizes="144x144" href="{{asset('storage/favicon/apple-icon-144x144.png')}}">
<link rel="apple-touch-icon" sizes="152x152" href="{{asset('storage/favicon/apple-icon-152x152.png')}}">
<link rel="apple-touch-icon" sizes="180x180" href="{{asset('storage/favicon/apple-icon-180x180.png')}}">
<link rel="icon" type="image/png" sizes="192x192"  href="{{asset('storage/favicon/android-icon-192x192.png')}}">
<link rel="icon" type="image/png" sizes="32x32" href="{{asset('storage/favicon/favicon-32x32.png')}}">
<link rel="icon" type="image/png" sizes="96x96" href="{{asset('storage/favicon/favicon-96x96.png')}}">
<link rel="icon" type="image/png" sizes="16x16" href="{{asset('storage/favicon/favicon-16x16.png')}}">
<link rel="manifest" href="{{asset('storage/favicon/manifest.json')}}">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="{{asset('storage/favicon/ms-icon-144x144.png')}}">
<meta name="theme-color" content="#ffffff">

<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('title')</title>
<meta name="description" content="@yield('description')">
@yield('head')
<link rel="stylesheet" href="{{asset('css/app.css')}}">
<meta name="facebook-domain-verification" content="iwcc5klugzvznucuiqc4rxje76jo41"/>

<meta property="og:locale" content="ru_RU">
<meta property="og:type" content="og:product">
<meta property="og:title" content="@yield('title')">
<meta property="og:description" content="@yield('description')">
<meta property="og:url" content="{{url()->current()}}">
<meta property="og:site_name" content="YouBrand">

@if(Route::is('product') )
    <meta property="product:price:amount" content="@if($product->sale_price){{$product->sale_price}}@else{{$product->price}}@endif"/>
    <meta property="product:price:currency" content="UAH"/>
    <meta property="og:image" content="{{asset($product->preview)}}">
@else
    <meta property="og:image" content="{{asset('storage/img/content/logo.png')}}">
@endif
