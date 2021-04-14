$(window).on('load', function() {
    $('.shop-products-slider-big').slick({
        asNavFor: '.shop-products-slider-small',
        arrows: false,
        lazyLoad: 'ondemand',
        responsive: [
        {
            breakpoint: 990,
            settings: {
                dots: false
            }
        }
        ]
    });
    $('.shop-products-slider-small').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.shop-products-slider-big',
        arrows: true,
        prevArrow: "<span class='icon-arrow-up2 arrow-prev'></span>",
        nextArrow: "<span class='icon-arrow-down2 arrow-next'></span>",
        focusOnSelect: true,
        vertical: true,
        verticalSwiping:true,
        swipe: true
    });
    $('.reviews-slider').slick({
        infinite: true,
        autoplay: true,
        autoplaySpeed: 4000,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        adaptiveHeight: true
    });
    $('.relative-slider').slick({
        infinite: true,
        arrows: true,
        prevArrow: "<span class='icon-arrow-left2 arrow-prev'></span>",
        nextArrow: "<span class='icon-arrow-right2 arrow-next'></span>",
        slidesToShow: 5,
        slidesToScroll: 1,
        responsive: [
        {
            breakpoint: 1366,
            settings: {
                slidesToShow: 4
            }
        },
        {
            breakpoint: 700,
            settings: {
                slidesToShow: 3
            }
        },
        {
            breakpoint: 500,
            settings: {
                slidesToShow: 2
            }
        }
        ]
    });
});
