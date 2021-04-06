$(function () {
    $('.header-burger').click(function(event) {
        $('.header-burger,.menu').toggleClass('active');
        $('body').toggleClass('menu-lock');
    });
    $('.menu__link').click(function(event){
        $('.header-burger,.menu').removeClass('active');
        $('body').removeClass('menu-lock');
    });
});
