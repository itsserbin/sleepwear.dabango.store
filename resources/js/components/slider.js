$(document).ready(function(){
    $('.shop-products-slider-big').slick({
        asNavFor: '.shop-products-slider-small',
        arrows: false,
        dots: true,
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
        slidesToShow: 5,
        slidesToScroll: 1,
        asNavFor: '.shop-products-slider-big',
        focusOnSelect: true,
        vertical: true,
        arrows: false
    });
    $('.reviews-slider').slick({
        infinite: true,
        autoplay: true,
        autoplaySpeed: 4000,
        slidesToShow: 2,
        slidesToScroll: 2,
        dots: true,
        adaptiveHeight: true,
        responsive: [
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
        ]
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
