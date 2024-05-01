
$(document).ready(function(){

    const swiper = new Swiper('.swiper-most-popular', {
        // Optional parameters
        //direction: 'vertical',
        loop: true,

        // Navigation arrows
        navigation: {
            nextEl: '.most-popular-swiper-button-next',
            prevEl: '.most-popular-swiper-button-prev',
        },
        speed: 1000,
        spaceBetween: 30,
        slidesPerView: 3,
    });
    const youtube = new Swiper('.swiper-youtube', {
        loop: true,
        speed: 1000,
        slidesPerView: 1,
        navigation: {
            nextEl: '.youtube-swiper-button-next',
            prevEl: '.youtube-swiper-button-prev',
        },
    });
    const authors = new Swiper('.swiper-authors', {
        loop: true,
        speed: 1000,
        slidesPerView: 1,
        navigation: {
            nextEl: '.authors-swiper-button-next',
            prevEl: '.authors-swiper-button-prev',
        },
    });

    $('.btnArticleResponse').click(function() {
        $('.response-form').toggle();
    });


});



