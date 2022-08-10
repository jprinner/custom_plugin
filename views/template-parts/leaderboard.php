<?php

function display_leaderboard($leaderboard_array){

  $leaderboard_logo = $leaderboard_array['settings']['podium_panel_header_image'];
  $podium_panel_background = $leaderboard_array['settings']['podium_panel_background'];
  $leaders_list_background =$leaderboard_array['settings']['leaders_list_background'];
  $split_or_full_background = $leaderboard_array['settings']['split_or_full_background'];
  $leaderboard_background = $leaderboard_array['settings']['leaderboard_background'];
  $leaderboard_background_color = $leaderboard_array['settings']['leaderboard_background_color'];
  $leaderboard_background_image = $leaderboard_array['settings']['leaderboard_background_image'];
  $podium_panel_background_image =$leaderboard_array['settings']['podium_panel_background_image'];
  $podium_panel_background_color =$leaderboard_array['settings']['podium_panel_background_color'];
  $leaders_list_background_color =$leaderboard_array['settings']['leaders_list_background_color'];
  $leaders_list_background_image =$leaderboard_array['settings']['leaders_list_background_image'];
  $primary_color = $leaderboard_array['settings']['primary_color'];
  $neutral_lite_color = $leaderboard_array['settings']['neutral_lite_color'];
  $full_status_bar = $leaderboard_array['settings']['full_status_bar'];
  $ldr_list = $leaderboard_array['rankings'];
  $ldr_list_count = count($ldr_list);
  $random = rand(1,10000);

  $full_background_design = '';
  $l_background_design= '';
  $p_background_design= '';
  if ($split_or_full_background == 'full'){
    if ($leaderboard_background == 'color'){
      $full_background_design = 'background-color:'.$leaderboard_background_color.';';
    }elseif($leaderboard_background == 'image'){
      $full_background_design = 'background-image: url('.$leaderboard_background_image.');';
    }else{
      $full_background_design = 'background-color:#fff;';
    }
  } else {
    if ($leaders_list_background == 'color'){
      $l_background_design = 'background-color:'.$leaders_list_background_color.';';
    }elseif($leaders_list_background == 'image'){
      $l_background_design = 'background-image: url('.$leaders_list_background_image.');';
    }else{
      $l_background_design = 'background-color:#fff;';
    }
    if ($podium_panel_background == 'color'){
      $p_background_design = 'background-color:'.$podium_panel_background_color.';';
    }elseif($podium_panel_background == 'image'){
      $p_background_design = 'background-image: url('.$podium_panel_background_image.');';
    }else{
      $p_background_design = 'background-color:#fff;';
    }
  }

  if ($primary_color == NULL){
    $primary_color = '#000';
  }
  $primary_color_lightened = luminanceLight($primary_color, .6);
  if ($neutral_lite_color == NULL){
    $neutral_lite_color = '#fff';
  }

  $leaderboard_code = '';
  $leaderboard_land_code = '';
  $leaderboard_port_code = '';
  $leaderboard_code .= '<div id="numb_posts" style="display:none;">'.$ldr_list_count.'</div>';
  $leaderboard_code .= '<div class="leaderboard-container" style="'.$full_background_design.'">';
  $leaderboard_code .= '
  <style type="text/css">
    .leaders-progress {
      background-color: '.$primary_color.';
    }
    .leaderboard-progress-bar {
      background-color: '.$primary_color.';
    }
    .leaderboard-progress {
      background-color: '.$primary_color_lightened.';
    }
    .leaderboard-wall-landscape-container-inner p, .leaderboard-wall-portrait-container-inner p {
      color: '.$neutral_lite_color.';
    }
  </style>';
  /*
  Horizontal Leaderboard
  */
  $leaderboard_land_code .= "<div class='leaderboard-wall-landscape-container'>";
  $leaderboard_land_code .= '
  <div class="leaderboard-wall-landscape-container-inner">
    <section class="leaderboard-leaders-landscape" style="'.$p_background_design.'">
      <div class="container logo-container">
        <div class="row leaderboard-logo" style="height:100%;">';
          if ($leaderboard_logo != NULL){
            $leaderboard_land_code .= '<img src='.$leaderboard_logo.'">';
          }
        $leaderboard_land_code .= '
        </div>
      </div>
      <div class="container" style="height:90%;margin-top:3%;">
        <div class="row" style="height:100%;">
          <div id="leaders-2" class="col-4" style="height:100%;">
            <div class="row leaders-headshot">
              <div class="col">';
                if($ldr_list[1]['headshot'] != NULL){
                $leaderboard_land_code .= '<img src="'.$ldr_list[1]['headshot'].'?r='.$random.'">';
                }
              $leaderboard_land_code .= '
              </div>
            </div>
            <div class="row leaders-details">
              <div class="col leaders-progress" style="height:100%;">';
              if($ldr_list[1]['first_name'] != NULL){
                $leaderboard_land_code .= '
                <div class="leaders-name">
                  <p>'.$ldr_list[1]['first_name'] . ' ' . $ldr_list[1]['last_name'].'</p>
                </div>
                <div class="leaders-points">
                  <p>'.$ldr_list[1]['points'].' pts</p>
                </div>';
              }else {
                $leaderboard_land_code .= '
                <div class="leaders-name">
                  <p>Player ranking coming soon!</p>
                </div>';
              }
              $leaderboard_land_code .= '
                <div class="leaders-rank">
                  <p>2</p>
                </div>
              </div>
            </div>
          </div>
          <div id="leaders-1" class="col-4" style="height:100%;">
            <div class="row leaders-headshot">
              <div class="col">';
                if($ldr_list[0]['headshot'] != NULL){
                $leaderboard_land_code .= '
                <img src="'.$ldr_list[0]['headshot'].'?r='.$random.'">';
                }
              $leaderboard_land_code .= '
              </div>
            </div>
            <div class="row leaders-details">
              <div class="col leaders-progress" style="height:100%;">';
              if($ldr_list[0]['first_name'] != NULL){
                $leaderboard_land_code .= '
                <div class="leaders-name">
                  <p>'.$ldr_list[0]['first_name'] . ' ' . $ldr_list[0]['last_name'].'</p>
                </div>
                <div class="leaders-points">
                  <p>'.$ldr_list[0]['points'].' pts</p>
                </div>';
              }else {
                $leaderboard_land_code .= '
                <div class="leaders-name">
                  <p>Player ranking coming soon!</p>
                </div>';
              }
              $leaderboard_land_code .= '
                <div class="leaders-rank">
                  <p>1</p>
                </div>
              </div>
            </div>
          </div>
          <div id="leaders-3" class="col-4" style="height:100%;">
            <div class="row leaders-headshot">
              <div class="col">';
                if($ldr_list[2]['headshot'] != NULL){
                $leaderboard_land_code .= '
                <img src="'.$ldr_list[2]['headshot'].'?r='.$random.'">';
                }
                $leaderboard_land_code .= '
              </div>
            </div>
            <div class="row leaders-details">
              <div class="col leaders-progress" style="height:100%;">';
              if($ldr_list[2]['first_name'] != NULL){
                $leaderboard_land_code .= '
                <div class="leaders-name">
                  <p>'.$ldr_list[2]['first_name'] . ' ' . $ldr_list[2]['last_name'].'</p>
                </div>
                <div class="leaders-points">
                  <p>'.$ldr_list[2]['points'].' pts</p>
                </div>';
              }else {
                $leaderboard_land_code .= '
                <div class="leaders-name">
                  <p>Player ranking coming soon!</p>
                </div>';
              }
              $leaderboard_land_code .= '
                <div class="leaders-rank">
                  <p>3</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      </section>
      <section class="leaderboard-list-landscape leaderboard-list-container" style="'.$l_background_design.'">
        <div class="container">';

  $leaderboard_port_code .= '
  <div class="leaderboard-wall-portrait-container">
  <div class="leaderboard-wall-portrait-container-inner">
    <section class="leaderboard-leaders-portrait" style="'.$p_background_design.'">';
      if ($leaderboard_logo != NULL){
      $leaderboard_port_code .= '
      <div class="container" style="height:10%;">
        <div class="row" style="height:100%;">
          <div class="leaderboard-logo" style="height:100%;">
            <img src='.$leaderboard_logo.' style="height:100%;">
          </div>
        </div>
      </div>';
      }
      $leaderboard_port_code .= '
      <div class="container top-leaders-portrait" style="height:90%;margin-top:2%;">
        <div class="row" style="height:100%;">
          <div id="leaders-2" class="col-4" style="height:100%;">
            <div class="row leaders-headshot">
              <div class="col">';
                if($ldr_list[1]['headshot'] != NULL){
                $leaderboard_port_code .= '
                <img src="'.$ldr_list[1]['headshot'].'?r='.$random.'">';
                }
                $leaderboard_port_code .= '
              </div>
            </div>
            <div class="row leaders-details">
              <div class="col leaders-progress" style="height:100%;">';
              if($ldr_list[1]['first_name'] != NULL){
                $leaderboard_port_code .= '
                <div class="leaders-name">
                  <p>'.$ldr_list[1]['first_name'] . ' ' . $ldr_list[1]['last_name'].'</p>
                </div>
                <div class="leaders-points">
                  <p>'.$ldr_list[1]['points'].' pts</p>
                </div>';
              } else {
                $leaderboard_port_code .= '
                <div class="leaders-name">
                  <p>Player ranking coming soon!</p>
                </div>';
              }
              $leaderboard_port_code .= '
                <div class="leaders-rank">
                  <p>2</p>
                </div>
              </div>
            </div>
          </div>
          <div id="leaders-1" class="col-4" style="height:100%;">
            <div class="row leaders-headshot">
              <div class="col">';
                if($ldr_list[0]['headshot'] != NULL){
                $leaderboard_port_code .= '
                <img src="'.$ldr_list[0]['headshot'].'?r='.$random.'">';
                }
                $leaderboard_port_code .= '
              </div>
            </div>
            <div class="row leaders-details">
              <div class="col leaders-progress" style="height:100%;">';
              if($ldr_list[0]['first_name'] != NULL){
                $leaderboard_port_code .= '
                <div class="leaders-name">
                  <p>'.$ldr_list[0]['first_name'] . ' ' . $ldr_list[0]['last_name'].'</p>
                </div>
                <div class="leaders-points">
                  <p>'.$ldr_list[0]['points'].' pts</p>
                </div>';
              }else {
                $leaderboard_port_code .= '
                <div class="leaders-name">
                  <p>Player ranking coming soon!</p>
                </div>';
              }
              $leaderboard_port_code .= '
                <div class="leaders-rank">
                  <p>1</p>
                </div>
              </div>
            </div>
          </div>
          <div id="leaders-3" class="col-4" style="height:100%;">
            <div class="row leaders-headshot">
              <div class="col">';
                if($ldr_list[2]['headshot'] != NULL){
                $leaderboard_port_code .= '
                <img src="'.$ldr_list[2]['headshot'].'?r='.$random.'">';
                }
                $leaderboard_port_code .= '
              </div>
            </div>
            <div class="row leaders-details">
              <div class="col leaders-progress" style="height:100%;">';
              if($ldr_list[2]['first_name'] != NULL){
                $leaderboard_port_code .= '
                <div class="leaders-name">
                  <p>'.$ldr_list[2]['first_name'] . ' ' . $ldr_list[2]['last_name'].'</p>
                </div>
                <div class="leaders-points">
                  <p>'.$ldr_list[2]['points'].' pts</p>
                </div>';
              }else {
                $leaderboard_port_code .= '
                <div class="leaders-name">
                  <p>Player ranking coming soon!</p>
                </div>';
              }
              $leaderboard_port_code .= '
                <div class="leaders-rank">
                  <p>3</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="leaderboard-list-portrait leaderboard-list-container" style="'.$l_background_design.'">
      <div class="container">';

          for($i=0;$i<count($ldr_list);$i++):
            $random = rand(1,10000);
            $p_id = '';
            $p = '';
            $total_points = $ldr_list[$i]['points'];
            $perc_points = $total_points/$full_status_bar;
            $perc_points = round( $perc_points  * 100 ). '%';
            $count = $i+1;
          $leaderboard_land_code .= '
          <style>
            .leaderboard-progress-width-'.$count.'{
              width: '.$perc_points.' !important;
            }
          </style>
          <div class="row align-items-center leaderboard-list cssanimation sequence" style="visibility:hidden;">
            <div class="leaderboard-rank col-1">
              <p>'.$count.'</p>
            </div>
            <div class="leaderboard-headshot col-2">
              <img src="'.$ldr_list[$i]['headshot'].'?r='.$random.'">
            </div>
            <div class="col leaderboard-stats">
              <div class="row align-items-center">
                <div class="col leaderboard-progress-bar">
                  <div class="row">
                    <div class="leaderboard-progress"></div>
                  </div>
                </div>
              </div>
              <div class="row leaderboard-details align-items-center">
                <div class="col leaderboard-name">
                  <p>'.$ldr_list[$i]['first_name'] . ' ' . $ldr_list[$i]['last_name'].'</p>
                </div>
                <div class="col-4 leaderboard-points">
                  <p data-count="'.$ldr_list[$i]['points'].'" class="points-counter"></p>
                </div>
              </div>
            </div>
          </div>';

        $leaderboard_port_code .= '
        <div class="row align-items-center leaderboard-list cssanimation sequence fadeInBottom">
          <div class="leaderboard-rank col-1">
            <p>'.$count.'</p>
          </div>
          <div class="leaderboard-headshot col-2">
            <img src="'.$ldr_list[$i]['headshot'].'?r='.$random.'">
          </div>
          <div class="col leaderboard-stats">
            <div class="row align-items-center">
              <div class="col leaderboard-progress-bar">
                <div class="row">
                  <div class="leaderboard-progress" style="width: '.$perc_points.';"></div>
                </div>
              </div>
            </div>
            <div class="row leaderboard-details align-items-center">
              <div class="col leaderboard-name">
                <p>'.$ldr_list[$i]['first_name'] . ' ' . $ldr_list[$i]['last_name'].'</p>
              </div>
              <div class="col-4 leaderboard-points">
                <p data-count="'.$ldr_list[$i]['points'].'" class="points-counter"></p>
              </div>
            </div>
          </div>
        </div>';
          endfor;
        $leaderboard_land_code .= '
        </div>
      </section>
    </div>
    </div><!--Leaderboard Wall Landscape Container-->';
    $leaderboard_land_code .= "<div class='error-message-overlay error-message-overlay-landscape'><p>Screen aspect ratio is too wide is display leaderboard data properly</p></div><!--Error Message Overlay-->";

    $leaderboard_port_code .= '
      </div>
    </section>
  </div>
  </div><!--Leaderboard Wall Portrait Container-->';
  $leaderboard_port_code .=  "<div class='error-message-overlay error-message-overlay-portrait'><p>Screen aspect ratio is too narrow is display leaderboard data properly</p></div><!--Error Message Overlay-->";

  $leaderboard_code .= $leaderboard_land_code.$leaderboard_port_code;
  $leaderboard_code .= '</div>';

  return $leaderboard_code;
}