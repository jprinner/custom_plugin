<?php

function return_api_array($data_type){ //Data type should either be leaderboard or photowall
  global $api_endpoint;
  global $leaderboard_api;
  global $photowall_api;
  global $token;
    if ($data_type == 'leaderboard'){
      //Get leaderboard API
      $chl = curl_init($leaderboard_api);
      curl_setopt($chl, CURLOPT_CUSTOMREQUEST, "GET");
      curl_setopt($chl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($chl, CURLOPT_CONNECTTIMEOUT, 42);
      curl_setopt($chl, CURLOPT_HTTPHEADER, array(
          'Accept: application/json',
          'Content-Type: application/json',
          'Authorization: Bearer '.$token,
          'Cache-Control: max-age=600'
          )
      );
      $leaderboard_json = curl_exec($chl);
    $leaderboard_array = json_decode($leaderboard_json, true);
    return $leaderboard_array;
    }
    if ($data_type == 'photowall'){
      //Get Photowall API
      $chp = curl_init($photowall_api);
      curl_setopt($chp, CURLOPT_CUSTOMREQUEST, "GET");
      curl_setopt($chp, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($chp, CURLOPT_CONNECTTIMEOUT, 42);
      curl_setopt($chp, CURLOPT_HTTPHEADER, array(
          'Accept: application/json',
          'Content-Type: application/json',
          'Authorization: Bearer '.$token,
          'Cache-Control: max-age=600'
          )
      );
      $photowall_json = curl_exec($chp);
      $photowall_array = json_decode($photowall_json, true);
      return $photowall_array;
  }

}