<!doctype html>
<html lang="RU">
<head>
	@include('components.head')
</head>
<body>
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
