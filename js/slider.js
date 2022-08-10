jQuery(document).ready( function($) {

  $('.wall-slider').slick({
      // autoplay: true,
      // autoplaySpeed: 20000,
      pauseOnFocus: false,
      pauseOnHover: false,
      arrows: false,
      speed: 1000
    });

  var $slider = $('.wall-slider');
  var activeSlides,
      currActiveSlide,
      firstSlide =  $slider.find("[data-slick-index='0']");
  $slider.on('beforeChange', function(event, slick, currentSlide, nextSlide){
      activeSlides = slick.$slides;
      $.each(activeSlides, function(k, v){
          if ($(v).hasClass('slick-active')){
              if ($(v).next().length){
                  currActiveSlide = $(v).next();
              } else {
                  currActiveSlide = firstSlide;
              }
              return;
          }
      });
  });
  $slider.on('afterChange', function(event, slick){
      setTimeout(function(){
          $slider.slick('slickNext');
      }, currActiveSlide.data('time'));
  });
  // on init
  setTimeout(function(){
      $slider.slick('slickNext');
  },firstSlide.data('time'));
  // Leaderboard Slide
  //Functions to resize container at certain aspect ratios
  //   function gcd(x, y){
  //     if (y == 0){ return x; }
  //     return gcd (y, x % y);
  // }
  // $(function() {
  //     $(window).resize(function() {
  //       var ratio = gcd($( window ).width(), $( window ).height());
  //     var testratio =  ($( window ).width()/ratio)/($( window ).height()/ratio);
  //     if(testratio>=1){//screen is wider than 16:9, do something}
  //       var height = $(this).height() - 200;
  //           $(".leaderboard-wall-portrait-container").css({
  //               "height": height,
  //               "width": height*(9/16)
  //           });
  //     }
  //     }).resize();
  // });

  current_slide = $('.slick-active').find('.horizontal-slider').attr('id');
  animateSlide(current_slide);
  function animateSlide(slide_type){
    if (slide_type == 'photowall-slide'){
      animatePhotowall();
    }
    else if (slide_type == 'leaderboard-slide'){
      animateLeaderboard()
    }
  }
  //Do all of this code when slide shows
  $(".wall-slider").on("afterChange", function (event, slick, currentSlide){
    if ($('.slick-active .photo-wall-grid').length){
      animatePhotowall();
    }
    if ($('.slick-active .leaderboard-container').length){
      animateLeaderboard()
    }
  });
});