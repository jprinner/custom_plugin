jQuery(document).ready( function($) {

  //var count = 1;
  function slideUpdate(slide_type){
    // if (count % 5 == 0){
    //   if (slide_type == 'photowall-slide'){
    //     resetPhotowallAnimation();
    //   }
    //   else if (slide_type == 'leaderboard-slide'){
    //     resetLeaderboardAnimation();
    //   }
    // } else {
      if (slide_type == 'photowall-slide'){
      photowallUpdate();
      }
      else if (slide_type == 'leaderboard-slide'){
        leaderboardUpdate();
      }
    //}
    //count++;
  }
  function determine_slide_to_update(){
    slide_to_update = '';
    current_slide = $('.slick-active').find('.horizontal-slider').attr('data-id');
    if (current_slide == 1){
      slide_to_update = $('.slick-slide:not(.slick-cloned) .horizontal-slider').last().attr('id');
    }
    else{
      previous_slide_num = current_slide - 1;
      slide_to_update = $(`[data-id='${previous_slide_num}']`).attr('id');
    }
    slideUpdate(slide_to_update);
  }
  determine_slide_to_update();
  $(".wall-slider").on("afterChange", function (event, slick, currentSlide){
    determine_slide_to_update();
  });
  function leaderboardUpdate(){

    // submit the data
    jQuery.post(ubs_gc_extension_ajax.ajaxurl, {
      nonce:     ubs_gc_extension_ajax.nonce,
      action:    "leaderboard_update",
      dataType: "json",

    }, function(data) {
      //unwrap data
      var data2 = JSON.parse(data);
      var leaderboard_view = data2.leaderboard_view;
      leaderboard_view = leaderboard_view.replace(/\\/g, '');
      // display data
      $('.leaderboard-slide').html(leaderboard_view);
    }).fail(function(response) {
      resetLeaderboardAnimation();
    });
  }
  function resetLeaderboardAnimation() {
    $(".leaderboard-list").css({"visibility" : "hidden"});
    $(".leaderboard-list").removeClass('fadeInBottom');
    $("#leaders-1 .leaders-details").css({
        "height": "0",
      });
      $("#leaders-2 .leaders-details").css({
          "height": "0",
      });
    $("#leaders-3 .leaders-details").css({
          "height": "0",
      });
    $('.leaders-headshot img').removeClass('headshot-pop');
    $('.leaders-name').removeClass('details-show');
    $('.leaders-points').removeClass('details-show');
    $('.leaders-rank').removeClass('details-show');
    $(".leaderboard-list-container .container").css({
        "-webkit-transform": "translateY(0px)",
        "transform": "translateY(0px)",
        "transition": "transform 0s linear"
    });
    $('.leaderboard-list-container .container').toggleClass("move-up");
  }

  function photowallUpdate(){
    // submit the data
    jQuery.post(ubs_gc_extension_ajax.ajaxurl, {
      nonce:     ubs_gc_extension_ajax.nonce,
      action:    "photowall_update",
      dataType: "json",

    }, function(data) {
      //unwrap data
      var data2 = JSON.parse(data);
      var photowall_view = data2.photowall_view;
      photowall_view = photowall_view.replace(/\\/g, '');
      // display data
      $('.photowall-slide').html(photowall_view);
    }).fail(function(response) {
      resetPhotowallAnimation();
    });
  }
  function resetPhotowallAnimation() {
    $(".photo-wall-image").css({"visibility" : "hidden"});
    $(".photo-wall-image").removeClass("fadeInBottom");
    $('.photo-wall-grid').toggleClass("move-up");
    $('.title-block').removeClass('title-block-show');
    $(".photo-wall-grid").css({
            "-webkit-transform": "translateY(0px)",
            "transform": "translateY(0px)",
            "transition": "transform 0s linear"
        });
  }

});