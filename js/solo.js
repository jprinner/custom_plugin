jQuery(document).ready( function($) {

  if ($('.photowall-container').length > 0) {
    animatePhotowall();
  }
  if ($('.leaderboard-container').length > 0) {
    animateLeaderboard()
  }
  setTimeout(function() {
    location.reload();
  }, 25000);
});