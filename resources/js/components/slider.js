$(window).on('load', function() {
    $('.shop-products-slider-big').slick({
        asNavFor: '.shop-products-slider-small',
        arrows: false,
        lazyLoad: 'ondemand',
        slidesToShow: 1,
        slidesToScroll: 1,
        swipeToSlide: true,
        focusOnSelect: true
    });
    $('.shop-products-slider-small').slick({
        asNavFor: '.shop-products-slider-big',
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        swipeToSlide: true,
        arrows: true,
        prevArrow: "<span class='icon-arrow-up2 arrow-prev'></span>",
        nextArrow: "<span class='icon-arrow-down2 arrow-next'></span>",
        focusOnSelect: true,
        vertical: true,
        verticalSwiping:true
    });
    $('.reviews-slider').slick({
        infinite: true,
        arrows: true,
        prevArrow: "<span class='icon-arrow-left2 arrow-prev'></span>",
        nextArrow: "<span class='icon-arrow-right2 arrow-next'></span>",
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
        },
        {
            breakpoint: 360,
            settings: {
                slidesToShow: 1
            }
        }
        ]
    });
//вертикальный скролл 
$(".shop-products-slider-big, .shop-products-slider-small").each(function() {
    this.slick.getSlideCount = function() {

        var _ = this,
        slidesTraversed, swipedSlide, centerOffset;


        centerOffset = _.options.centerMode === true ? _.slideWidth * Math.floor(_.options.slidesToShow / 2) : 0;

        if (_.options.swipeToSlide === true) {

            _.$slideTrack.find('.slick-slide').each(function(index, slide) {
                var offsetPoint = slide.offsetLeft,
                outerSize = $(slide).outerWidth();

                if(_.options.vertical === true) {
                    offsetPoint = slide.offsetTop;
                    outerSize = $(slide).outerHeight();
                }
                if (offsetPoint - centerOffset + (outerSize / 2) > (_.swipeLeft * -1)) {
                    swipedSlide = slide;
                    return false;
                }
            });
            slidesTraversed = Math.abs($(swipedSlide).attr('data-slick-index') - _.currentSlide) || 1;

            return slidesTraversed;
        } else {
            return _.options.slidesToScroll;
        }

    };

    this.slick.getNavigableIndexes = function() {

        var _ = this,
        breakPoint = 0,
        counter = 0,
        indexes = [],
        max;

        if (_.options.infinite === false) {
            max = _.slideCount;
        } else {
            breakPoint = _.options.slideCount * -1;
            counter = _.options.slideCount * -1;
            max = _.slideCount * 2;
        }

        while (breakPoint < max) {
            indexes.push(breakPoint);
            breakPoint = counter + _.options.slidesToScroll;
            counter += _.options.slidesToScroll <= _.options.slidesToShow ? _.options.slidesToScroll : _.options.slidesToShow;
        }

        return indexes;

    };
});

});