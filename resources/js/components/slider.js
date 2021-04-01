$(document).ready(function(){
    $('.shop-products-slider-big').slick({
        asNavFor: '.shop-products-slider-small',
        arrows: false,
        swipe: false,
        responsive: [
        {
            breakpoint: 990,
            settings: {
                dots: false,
                swipe: false
            }
        }
        ]
    });
    $('.shop-products-slider-small').slick({
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        asNavFor: '.shop-products-slider-big',
        focusOnSelect: true,
        vertical: true,
        arrows: true,
        prevArrow:"<span class='icon-arrow-up2 prev'></span>",
        nextArrow:"<span class='icon-arrow-down2 next'></span>",
        swipe: true
    });
    $('.reviews-slider').slick({
        infinite: true,
        autoplay: true,
        autoplaySpeed: 4000,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        adaptiveHeight: true
    });
    $('.relative-slider').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 2,
        responsive: [
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 2
            }
        }
        ]
    });
});
