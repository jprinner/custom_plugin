$ = jQuery;
  //Functions to resize container at certain aspect ratios
  //   function gcd(x, y){
  //     if (y == 0){ return x; }
  //     return gcd (y, x % y);
  // }
  // $(function() {
  //     $(window).resize(function() {
  //     var ratio = gcd($( window ).width(), $( window ).height());
  //     var testratio =  ($( window ).width()/ratio)/($( window ).height()/ratio);
  //     if(testratio>=1){//screen is wider than 16:9, do something}
  //       $(".leaderboard-wall-landscape-container").show();
  //       // var height = $(this).height() - 200;
  //       //     $(".leaderboard-wall-portrait-container").css({
  //       //         "height": height,
  //       //         "width": height*(9/16)
  //       //     });
  //     } else if (testratio<1){
  //       $(".leaderboard-wall-landscape-container").hide();
  //     }
  //     }).resize();
  // });
function animateLeaderboard(){
  $(".leaderboard-list").css({"visibility" : "visible"});
  $(".slick-active .leaderboard-list").addClass('fadeInBottom');
  $("#leaders-1 .leaders-details").css({
    "height": "70%",
  });
  $("#leaders-2 .leaders-details").css({
    "height": "52%",
  });
  $("#leaders-3 .leaders-details").css({
    "height": "33%",
  });
  $("#leaders-1 .leaders-details").one("webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend", function(event) {
    $('.leaders-headshot img').addClass('headshot-pop');
    $('.leaders-headshot').css({
      "visibility": "visible",
    });
    $('.leaders-name').addClass('details-show');
    $('.leaders-points').addClass('details-show');
    $('.leaders-rank').addClass('details-show');
  });
  //Delay each leaderboard person row by an extra amount of time
  var animation_delay = 0;
  var listitem_count = 1;
  $(".slick-active .leaderboard-list").each(function(){
    animation_delay = animation_delay+150;
    $(this).css({
      "animation-delay" : animation_delay+"ms",
    });
  var $this = $(this);
  $this.find(".leaderboard-progress").addClass("leaderboard-progress-width-"+listitem_count);
    listitem_count++;
      countTo = $this.find(".points-counter").attr('data-count');
    $({ countNum: $this.find(".points-counter").text()}).animate({
      countNum: countTo
    },{
        duration: 2000,
        easing:'linear',
        step: function() {
            $this.find(".points-counter").text(Math.floor(this.countNum) + " PTS");
        },
        complete: function() {
           $this.find(".points-counter").text(this.countNum + " PTS");
        }
    });
  });
  setTimeout(function() {
    var pLeaderboardHeight = $(".leaderboard-list-portrait").height();
    var pLeaderboardListHeight = $(".leaderboard-list-portrait .leaderboard-list").first().height();
    pLeaderboardListHeight = pLeaderboardListHeight*$("#numb_posts").text();
    if (pLeaderboardListHeight > pLeaderboardHeight){
      var pLeaderboardHeightDifferenceNeg = pLeaderboardHeight - pLeaderboardListHeight;
      var pLeaderboardHeightDifferencePos = pLeaderboardListHeight - pLeaderboardHeight;
      var pLeaderboardHeightDiffPosPerc = ((pLeaderboardHeightDifferencePos/pLeaderboardHeight)*100)*.6;
      ptranslateY = 'translateY('+pLeaderboardHeightDifferenceNeg+'px)';
      ptransition = 'transform '+pLeaderboardHeightDiffPosPerc+'s linear';
      $(".slick-active .leaderboard-list-portrait .container").css({
        "transition" : ptransition,
            "-webkit-transform": ptranslateY,
            "transform": ptranslateY,
        });
    }
    var lLeaderboardHeight = $(".leaderboard-list-landscape").height();
    var lLeaderboardListHeight = $(".leaderboard-list-landscape .leaderboard-list").first().height();
    lLeaderboardListHeight = lLeaderboardListHeight*$("#numb_posts").text();
    if (lLeaderboardListHeight > lLeaderboardHeight){
      var lLeaderboardHeightDifferenceNeg = lLeaderboardHeight - lLeaderboardListHeight;
      var lLeaderboardHeightDifferencePos = lLeaderboardListHeight - lLeaderboardHeight;
      var lLeaderboardHeightDiffPosPerc = ((lLeaderboardHeightDifferencePos/lLeaderboardHeight)*100)*.6;
      ltranslateY = 'translateY('+lLeaderboardHeightDifferenceNeg+'px)';
      ltransition = 'transform '+lLeaderboardHeightDiffPosPerc+'s linear';
      $(".slick-active .leaderboard-list-landscape .container").css({
            "transition" : ltransition,
            "-webkit-transform": ltranslateY,
            "transform": ltranslateY,
        });
    }
    $('.slick-active .leaderboard-list-container .container').addClass("move-up");
  }, 3000);
  $(".leaderboard-list-container").one("webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend", function(event) {
    // setTimeout(function() {
    //   location.reload();
    // }, 25000);
  });
}

