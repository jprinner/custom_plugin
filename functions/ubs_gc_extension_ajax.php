<?php
// leaderboard data
function leaderboard_update() {
  // check nonce
  check_ajax_referer( 'ubs_gc_extension_ajax', 'nonce' );
  //get data
  global $gc_extension_dir;
  include_once( $gc_extension_dir . 'views/template-parts/leaderboard.php');

  // Enable shortcodes
  $data_type = 'leaderboard';
  $leaderboard_array = return_api_array($data_type);

  if(isset($leaderboard_array['rankings'])){
    $leaderboard_view = display_leaderboard($leaderboard_array);
  }
  else {
    $leaderboard_view = false;
  }
  $results = array(
    'leaderboard_view' => $leaderboard_view,
  );
  // output results
  print json_encode($results);
  // end processing
  wp_die();
}
// ajax hook for logged-in users: wp_ajax_{action}
add_action( 'wp_ajax_leaderboard_update', 'leaderboard_update' );
// ajax hook for non-logged-in users: wp_ajax_nopriv_{action}
add_action( 'wp_ajax_nopriv_leaderboard_update', 'leaderboard_update' );

function photowall_update() {
  // check nonce
  check_ajax_referer( 'ubs_gc_extension_ajax', 'nonce' );
  //get data
  global $gc_extension_dir;
  include_once( $gc_extension_dir . 'views/template-parts/photo-wall.php');

  // Enable shortcodes
  $data_type = 'photowall';
  $photowall_array = return_api_array($data_type);

  if(isset($photowall_array['images'])){
  $photowall_view = display_photowall($photowall_array);
  }
  else {
    $photowall_view = false;
  }

  $results = array(
    'photowall_view' => $photowall_view,
  );
  // output results
  print json_encode($results);

  // end processing
  wp_die();
}
// ajax hook for logged-in users: wp_ajax_{action}
add_action( 'wp_ajax_photowall_update', 'photowall_update' );
// ajax hook for non-logged-in users: wp_ajax_nopriv_{action}
add_action( 'wp_ajax_nopriv_photowall_update', 'photowall_update' );