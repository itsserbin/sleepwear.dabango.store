$(function () {
	$('.header-burger').click(function(event) {
		$('.header-burger,.header__fade').toggleClass('active');
		$('body').toggleClass('menu-lock');
		$('.header > .row').toggleClass('fade');
	});
	$('.menu__link').click(function(event){
		$('.header-burger,.header__fade').removeClass('active');
		$('body').removeClass('menu-lock');
		$('.header > .row').removeClass('fade');
	});
});
