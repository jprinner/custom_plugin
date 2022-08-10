<?php

function display_photowall($photowall_array){

  $page_background_color = $photowall_array['settings']['page_background_color'];
  $overlay_box_background_color = $photowall_array['settings']['overlay_box_background_color'];
  $font_color = $photowall_array['settings']['font_color'];

  if ($page_background_color == NULL) {
    $page_background_color = '#000000';
  }
  if ($overlay_box_background_color == NULL){
    $overlay_box_background_color = '#000000';
  }
  if ($font_color == NULL){
    $font_color = '#ffffff';
  }
  $photowall_code='';
  $photowall_code .= '
  <style type="text/css">
  body, .ocm-effect-wrap {
    background-color: '.$page_background_color.' !important;
  }
  .photowall-slide:before, .photowall-slide:after {
    background: '.$page_background_color.';
  }
  .photo-wall {
    background-color: '.$page_background_color.';
  }
  .title-block {
    background-color: '.$overlay_box_background_color.'99;
  }
  .photo-wall-title {
      color: '.$font_color.';
  }
  .photo-wall-subtext {
    color: '.$font_color.';
  }
  .photo-wall-grid {
      background-color: '.$page_background_color.';
  }
  .not-enough-photos {
    color: '.$font_color.';
  }
  </style>';

  //Page Data
  $overlay = '';
  if ($photowall_array['settings']['text_or_logo'] == 'title_sub'){
    $overlay .=
    '<div class="title-block-container">
      <div class="title-block">
        <h2 class="photo-wall-title">'.$photowall_array['settings']['title'].'</h2>
        <div class="photo-wall-subtext">'.$photowall_array['settings']['subtitle'].'</div>
      </div>
    </div>';
  }
  elseif ($photowall_array['settings']['text_or_logo'] == 'title'){
    $overlay .=
    '<div class="title-block-container">
      <div class="title-block">
        <h2 class="photo-wall-title">'.$photowall_array['settings']['title'].'</h2>
      </div>
    </div>';
  }
  elseif ($photowall_array['settings']['text_or_logo'] == 'logo_sub'){
    $overlay .=
    '<div class="title-block-container">
      <div class="title-block">
        <img class="photo-wall-logo" src="'.$photowall_array['settings']['logo'].'">
        <div class="photo-wall-subtext">'.$photowall_array['settings']['subtitle'].'</div>
      </div>
    </div>';
  }
  elseif ($photowall_array['settings']['text_or_logo'] == 'logo'){
    $overlay .=
    '<div class="title-block-container">
      <div class="title-block">
        <img class="photo-wall-logo" src="'.$photowall_array['settings']['logo'].'">
      </div>
    </div>';
  }

  $photowall_code .= '<div class="photowall-container">
    <section class="photo-wall">';
    if ($photowall_array['settings']['enable_overlay'] == true){
      $photowall_code .= $overlay;
    }
    if ($photowall_array['settings']['photo_submissions_count'] <= 12){
      if($photowall_array['settings']['photo_threshold'] == 'error'){
        $photowall_code = "<h2 class='not-enough-photos'>".$photowall_array['settings']['error_text']."</h2>";

      }
    }
    $photowall_code .= '<div class="photo-wall-grid">';
      if (count($photowall_array['images']) >= $photowall_array['settings']['photo_stream_count']){

        $ort_array = [];
        for ($i=0;$i<count($photowall_array['images']);$i++){
          //if we're using submissions then grab the image url from the object
          if ($photowall_array['settings']['photo_submissions_count'] >= 12){
            $image_url = $photowall_array['images'][$i]['image_url'];
          //if we're using options photos when grab the image url from the array
          } else {
            $image_url = $photowall_array['images'][$i]['image'];
          }
          $ort = $photowall_array['images'][$i]['orientation'];
          $random = rand(1,10000);
          $image_url = $image_url.'?r='.$random;
          $count = $i+1;
          if ($ort == 3){
            $photowall_code .= '<div class="photo-wall-image photo-wall-image-'.$count.' cssanimation sequence" style="visibility: hidden;"><span class="background-image" style="background-image: url('. $image_url.'); background-size: cover; transition: transform 0s linear !important; -webkit-transform: rotate(-90deg); -moz-transform: rotate(-90deg); -o-transform: rotate(-90deg); -ms-transform: rotate(-90deg); transform: rotate(-90deg);transition-delay: 0s;"></span></div>';
          } elseif ($ort == 6){
            $photowall_code .= '<div class="photo-wall-image photo-wall-image-'.$count.' cssanimation sequence" style="visibility: hidden;"><span class="background-image" style="background-image: url('.$image_url.'); background-size: cover; transition: transform 0s linear !important; -webkit-transform: rotate(90deg); -moz-transform: rotate(90deg); -o-transform: rotate(90deg); -ms-transform: rotate(90deg); transform: rotate(90deg);transition-delay: 0s;"></span></div>';
          }else {
            $photowall_code .= '<div class="photo-wall-image photo-wall-image-'.$count.' cssanimation sequence" style="visibility: hidden;"><span class="background-image" style="background-image: url('.$image_url.'); background-size: cover;"></span></div>';
          }
        }
      }

    $photowall_code .= '</div>';
    $photowall_code .= '</section>
    </div>';
  return $photowall_code;
}