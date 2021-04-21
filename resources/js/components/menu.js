$(function () {
	$('.header-burger').click(function(event) {
		$('.header-burger,.burger-menu').toggleClass('active');
		$('body').toggleClass('menu-lock');
		$('.header').toggleClass('active');
		$('.header').removeClass('shadow');
	});
	$('.menu__link').click(function(event){
		$('.header-burger,.burger-menu').removeClass('active');
		$('body').removeClass('menu-lock');
		$('.header').removeClass('active');
	});
});