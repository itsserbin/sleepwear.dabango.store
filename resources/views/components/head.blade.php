<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>@yield('title')</title>
<meta name="description" content="@yield('description')">
@yield('head')
<link rel="stylesheet" href="{{asset('css/app.css')}}">
<meta name="facebook-domain-verification" content="iwcc5klugzvznucuiqc4rxje76jo41" />

<meta property="og:locale" content="ru_RU">
<meta property="og:type" content="og:product">
<meta property="og:title" content="@yield('title')">
<meta property="og:image" content="{{asset('storage/img/content/logo.png')}}">
<meta property="og:description" content="@yield('description')">
<meta property="og:url" content="{{url()->current()}}">
