// slick_slider
$(function() {
    $('.slider-for').slick({
       slidesToShow: 1,
       autoplay:true,
       slidesToScroll: 1,
       arrows: false,
       fade: true,
       asNavFor: '.slider-nav'
    });
    $('.slider-nav').slick({
       slidesToShow: 3,
       slidesToScroll: 1,
       asNavFor: '.slider-for',
       dots: true,
       autoplay:true,
       centerMode: true,
       focusOnSelect: true
    });
});