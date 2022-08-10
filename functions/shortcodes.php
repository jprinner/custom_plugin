<?php

function add_photowall() {
  global $gc_extension_dir;
  include_once( $gc_extension_dir . 'views/template-parts/photo-wall.php');
  wp_enqueue_style( 'photowall-style' );
  wp_enqueue_style( 'solo-style' );
  wp_enqueue_style( 'bootstrap');
  wp_enqueue_style( 'cssanimation' );
  wp_enqueue_script( 'photowall-js' );
  wp_enqueue_script( 'solo-js' );

  $data_type = 'photowall';
  $photowall_array = return_api_array($data_type);
  $return .= '
  <div class="col-12">
  <div class="horizontal-slider photowall-slide slick-active" id="photowall-slide">';
    $return .= display_photowall($photowall_array);
    $return .= '
  </div>
  </div>';

  return $return;
}
add_shortcode('photowall', 'add_photowall');

function add_leaderboard() {
  global $gc_extension_dir;
  include_once( $gc_extension_dir . 'views/template-parts/leaderboard.php');
  wp_enqueue_style( 'leaderboard-style' );
  wp_enqueue_style( 'solo-style' );
  wp_enqueue_style( 'bootstrap');
  wp_enqueue_style( 'cssanimation' );
  wp_enqueue_script( 'leaderboard-js' );
  wp_enqueue_script( 'solo-js' );

  $data_type = 'leaderboard';
  $leaderboard_array = return_api_array($data_type);
  $return .= '
  <div class="col-12">
  <div class="horizontal-slider leaderboard-slide slick-active" id="leaderboard-slide">';
  $return .= display_leaderboard($leaderboard_array);
  $return .= '
  </div>
  </div>';

  return $return;
}
add_shortcode('leaderboard', 'add_leaderboard');

function add_photo_leaderboard_slider() {

  global $gc_extension_dir;
  include_once( $gc_extension_dir . 'views/template-parts/photo-wall.php');
  include_once( $gc_extension_dir . 'views/template-parts/leaderboard.php');
  wp_enqueue_style( 'photowall-style' );
  wp_enqueue_style( 'leaderboard-style' );
  wp_enqueue_style( 'slider-style' );
  wp_enqueue_style( 'bootstrap');
  wp_enqueue_style( 'cssanimation' );
  wp_enqueue_script( 'photowall-js' );
  wp_enqueue_script( 'leaderboard-js' );
  wp_enqueue_style( 'slickcss');
  wp_enqueue_style( 'slickcsstheme' );
  wp_enqueue_script( 'slickjs' );
  wp_enqueue_script( 'slider-js' );

  $return = '';
  $return .= '
  <div class="col-12">
    <div class="wall-slider">';
  $slides = get_field('slides', 'option');
  $count = 1;

  foreach($slides as $slide){

    if (!isset($slide['duration']) || $slide['duration'] == NULL){
      $slide['duration'] = 20;
    }
    $duration = $slide['duration'] * 1000;
    if ($slide['slide'] == 'leaderboard'){
      $return .= '
          <div data-time="'.$duration.'">
              <div class="horizontal-slider leaderboard-slide" data-id="'.$count.'" id="leaderboard-slide">';
              if ($count == 1){
                $leaderboard_data_type = 'leaderboard';
                $leaderboard_array = return_api_array($leaderboard_data_type);
                $return .= display_leaderboard($leaderboard_array);
              }
              $return .= '
              </div>
          </div>';
    }
    elseif ($slide['slide'] == 'photowall'){
      $return .= '
        <div data-time="'.$duration.'">
            <div class="horizontal-slider photowall-slide" data-id="'.$count.'" id="photowall-slide">';
            if ($count == 1){
              $photowall_data_type = 'photowall';
              $photowall_array = return_api_array($photowall_data_type);
              $return .= display_photowall($photowall_array);
            }
            $return .= '
            </div>
        </div>';
    }
    $count++;
  }
      $return .= '
    </div>
  </div>';

  return $return;
}
add_shortcode('photo_leaderboard_slider', 'add_photo_leaderboard_slider');