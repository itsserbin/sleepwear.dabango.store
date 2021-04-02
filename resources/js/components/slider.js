$(window).on('load', function() {
    $('.shop-products-slider-big').slick({
        asNavFor: '.shop-products-slider-small',
        arrows: false,
        swipe: true,
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
        infinite: false,
        slidesToShow: 10,
        slidesToScroll: 1,
        asNavFor: '.shop-products-slider-big',
        arrows: false,
        focusOnSelect: true,
        vertical: true,
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
        arrows: false,
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
