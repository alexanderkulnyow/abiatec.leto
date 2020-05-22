jQuery(document).ready(function () {
    jQuery('.slick__container').slick({
        // infinite: true,
        centerMode: true,
        centerPadding: '600',
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: true,
        arrows: true,
        prevArrow: jQuery('.slick__prev'),
        nextArrow: jQuery('.slick__next')
    });
});
