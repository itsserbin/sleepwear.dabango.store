$(function () {
    $('.header-burger').click(function(event) {
        $('.header-burger,.header__fade').toggleClass('active');
        $('body').toggleClass('menu-lock');
    });
    $('.menu__link').click(function(event){
        $('.header-burger,.header__fade').removeClass('active');
        $('body').removeClass('menu-lock');
    });
});
