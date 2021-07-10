$(window).scroll(function () {
    if ($(this).scrollTop() > 3) {
        $('.header').addClass("shadow");
    } else {
        $('.header').removeClass("shadow");
    }
});
