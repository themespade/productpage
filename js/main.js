

jQuery(document).ready(function($){

    $(window).scroll(function() {
        if ($(this).scrollTop() > 1){
            $('.site-header').addClass("ts-sticky");
        }
        else
        {
            $('.site-header').removeClass("ts-sticky");
        }});


    $('.ts-menu-icon').click(function() {
        $('.ts-main-navigation').toggleClass('visible');
        if($(this).children('.fa').hasClass('fa-navicon'))
        {
            $(this).children('.fa').removeClass('fa-navicon');
            $(this).children('.fa').addClass('fa-close');
        }
        else{
            $(this).children('.fa').removeClass('fa-close');
            $(this).children('.fa').addClass('fa-navicon');
        }
    });





// Main-Slider
    var swiper1 = new Swiper('.swiper-container1', {
        pagination: '.swiper-pagination',
        paginationClickable: true,
        slidesPerView: 1,
        spaceBetween: 0,
        loop: true,
        autoplay: 3000,
        speed: 900,
    });

// Review-Slider
    var swiper = new Swiper('.swiper-container', {
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        slidesPerView: 1,
        spaceBetween: 0,
        loop: true,
        speed: 900,
    });

// Top Scroll
    $(window).scroll(function() {
        if ($(this).scrollTop() > 1){
            $('.ts-scroll-top').addClass("show");
        }
        else{
            $('.ts-scroll-top').removeClass("show");
        }
    });
    $(".ts-scroll-top").on("click", function() {
        $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    });

//Accordian
    jQuery(function() {
      $('.faqs-block h4').on('click',function() {
        $('.faqs-block p').slideUp('normal');
        $(this).next('.faqs-block p').slideDown('normal'); 
        $(this).find('.faqs-block p').addClass('active');
        $(this).find('.faqs-block p').removeClass('active'); 
        $(this).find('.faqs-block h4').addClass('active');
        $(this).find('.faqs-block h4').removeClass('active'); 
      });
    });


// ScrollSpeed
//jQuery.scrollSpeed(120, 800);


});