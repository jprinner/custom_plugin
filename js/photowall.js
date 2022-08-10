  $ = jQuery;
  //Photowall animation
  function animatePhotowall(){
    // $(".photo-wall-image").show();
    $(".photo-wall-image").css({"visibility" : "visible"});
    var $photo_animation_delay = 0;
    var $listitem_count = 1;
    $(".slick-active .photo-wall-image").each(function(){
        $(this).css({
          "animation-delay" : $photo_animation_delay+"ms",
        });
        $photo_animation_delay = $photo_animation_delay+100;
      });
    $(".slick-active .photo-wall-image").addClass("fadeInBottom");
    //Photo Wall Animation
    $(".photo-wall-image-24").one("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(event) {
      var photoWallHeight = $(".photowall-slide").height();
        var photoWallPhotosHeight = $(".photo-wall-grid").height();
        if (photoWallPhotosHeight > photoWallHeight){
          var photoWallHeightDifferenceNeg = photoWallHeight - photoWallPhotosHeight;
          var photoWallHeightDifferencePos = photoWallPhotosHeight - photoWallHeight;
          var photoWallHeightDiffPosPerc = ((photoWallHeightDifferencePos/photoWallHeight)*100)*.6;
          translateY = 'translateY('+photoWallHeightDifferenceNeg+'px)';
          transition = 'transform '+photoWallHeightDiffPosPerc+'s linear';
          $(".photo-wall-grid").css({
            "transition" : transition,
            "-webkit-transform": translateY,
            "transform": translateY,
          });
        }
      $('.slick-active .photo-wall-grid').toggleClass("move-up");
      $('.title-block').addClass('title-block-show');
    });
  }