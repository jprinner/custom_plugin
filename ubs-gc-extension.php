<?php
/*
Plugin Name:  UBS Game Center Extension Pack
Description:  Enterprise WP plugin to connect websites with the game center
Version:      1.0.0
Author:       Sherilyn Villareal and Jessi Prinner
License:      GPL3
License URI:  https://www.gnu.org/licenses/gpl-3.0.html
Text Domain:  ubs-PLUGIN-TEMPLATE
*/
//enqueue scripts
function ubs_gc_extension_scripts() {
  // wp_enqueue_script('jquery');
  // wp_enqueue_script('jquery-ui-datepicker');
  wp_register_script( 'photowall-js', plugin_dir_url( __FILE__ ) . '/js/photowall.js', array('jquery'),'',true );
  wp_register_script( 'leaderboard-js', plugin_dir_url( __FILE__ ) . '/js/leaderboard.js', array('jquery'),'',true );
  wp_register_script( 'solo-js', plugin_dir_url( __FILE__ ) . '/js/solo.js', array('jquery'),'',true );
  wp_register_script( 'slider-js', plugin_dir_url( __FILE__ ) . '/js/slider.js', array('jquery', 'slickjs', 'photowall-js', 'leaderboard-js'),'',true );

  //Enqueue slick slider
  wp_register_script( 'slickjs', plugin_dir_url( __FILE__ ) . '/includes/slick-slider/slick.min.js', array( 'jquery' ), '1.8.1', true );
  wp_register_style( 'slickcss', plugin_dir_url( __FILE__ ) . 'includes/slick-slider/slick.css', '1.8.1', 'all');
  wp_register_style( 'slickcsstheme', plugin_dir_url( __FILE__ ) . 'includes/slick-slider/slick-theme.css', '1.8.1', 'all');

  //Load AJAX scripts
  $script_url = plugins_url( '/js/ubs-gc-extension-ajax.js', __FILE__ );
  wp_enqueue_script( 'ubs-gc-extension-ajax', $script_url, array( 'jquery',  'slider-js', 'photowall-js', 'leaderboard-js') );
  $nonce = wp_create_nonce( 'ubs_gc_extension_ajax' );
  $ajax_url = admin_url( 'admin-ajax.php' );
  $script = array( 'nonce' => $nonce, 'ajaxurl' => $ajax_url );
  wp_localize_script( 'ubs-gc-extension-ajax', 'ubs_gc_extension_ajax', $script );

  //load stylesheets
  wp_register_style( 'ubs-gc-extension-style', plugin_dir_url( __FILE__ ) . 'css/style.css'  );
  wp_register_style( 'cssanimation', plugin_dir_url( __FILE__ ) . 'includes/cssanimation/cssanimation.min.css'  );
  wp_register_style( 'bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css' );
  wp_register_style( 'photowall-style', plugins_url( '/css/photowall.css', __FILE__ ), array(), '1.0.0', 'all' );
  wp_register_style( 'leaderboard-style', plugins_url( '/css/leaderboard.css', __FILE__ ), array(), '1.0.0', 'all' );
  wp_register_style( 'solo-style', plugins_url( '/css/solo.css', __FILE__ ), array(), '1.0.0', 'all' );
  wp_register_style( 'slider-style', plugins_url( '/css/slider.css', __FILE__ ), array(), '1.0.0', 'all' );
}
add_action( 'wp_enqueue_scripts', 'ubs_gc_extension_scripts' );
//Load other Directories
global $gc_extension_dir;
global $leaderboard_api;
global $photowall_api;
global $api_endpoint;
$api_domain = get_field('api_domain', 'option');
$api_domain = sanitize_text_field($api_domain);
$wall_api_key = get_field('wall_api_key', 'option');
$wall_api_key = sanitize_text_field($wall_api_key);
$leaderboard_api = $api_domain.'/wp-json/ubs-games/v1/leaderboard-settings/akey='.$wall_api_key;
$photowall_api = $api_domain.'/wp-json/ubs-games/v1/photowall-settings/akey='.$wall_api_key;
$api_endpoint = $api_domain.'/wp-json/jwt-auth/v1/token';
$gc_extension_dir = plugin_dir_path( __FILE__ );
include_once( $gc_extension_dir . 'views/load.php');
include_once( $gc_extension_dir . 'functions/load.php');

//Create Admin Settings Interface
function gc_extension_menu_add(){
 if( function_exists('acf_add_options_page') ) {
    // add parent
    $parent = acf_add_options_page(array(
      'page_title'  => 'GC Extension Settings',
      'menu_title'  => 'GC Extension Settings',
      'capability' => 'edit_posts',
      'icon_url' => 'dashicons-admin-generic',
      'position'  => '90.1',
      'redirect' => true,
      'post_id' => 'options',
      'autoload' => false,
      'update_button'   => __('Save', 'acf'),
      'updated_message' => __("Options Saved", 'acf'),
    ));
    // add sub pages
    acf_add_options_sub_page(array(
      'page_title'  => 'Wall API Config',
      'menu_title'  => 'Wall API Config',
      'parent_slug'   => $parent['menu_slug'],
    ));
  }
}
add_action('init','gc_extension_menu_add');

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
  'key' => 'group_5f20ae16948e8',
  'title' => 'GC Extension Settings',
  'fields' => array(
    array(
      'key' => 'field_5f20ae70c8f13',
      'label' => 'API Domain',
      'name' => 'api_domain',
      'type' => 'text',
      'instructions' => 'Please input the domain of the site with the API you\'d like to populate data from. Please also include the protocol identifier, for example: "https://example.unbridled.games"',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => '',
      'prepend' => '',
      'append' => '',
      'maxlength' => '',
    ),
    array(
      'key' => 'field_5f20ae94c8f14',
      'label' => 'Wall API KEY',
      'name' => 'wall_api_key',
      'type' => 'text',
      'instructions' => 'Please add the Wall API Key found in the game center.',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => '',
      'prepend' => '',
      'append' => '',
      'maxlength' => '',
    ),
    array(
      'key' => 'field_5f341defed8f6',
      'label' => 'Wall Shortcodes',
      'name' => '',
      'type' => 'message',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'message' => 'Use the following shortcodes to add a leaderboard or photowall to a page:

Leaderboard: [leaderboard]
Photowall: [photowall]
Slider: [photo_leaderboard_slider]',
      'new_lines' => 'wpautop',
      'esc_html' => 0,
    ),
    array(
      'key' => 'field_5f2c6b356d660',
      'label' => 'Slides',
      'name' => 'slides',
      'type' => 'repeater',
      'instructions' => 'Please select the slides and slide durations for the leaderboard/photowall slider shortcode.',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'collapsed' => '',
      'min' => 2,
      'max' => 0,
      'layout' => 'table',
      'button_label' => 'Add Slide',
      'sub_fields' => array(
        array(
          'key' => 'field_5f2c6b796d661',
          'label' => 'Slide',
          'name' => 'slide',
          'type' => 'select',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'choices' => array(
            'photowall' => 'Photowall',
            'leaderboard' => 'Leaderboard',
          ),
          'default_value' => 'photowall',
          'allow_null' => 0,
          'multiple' => 0,
          'ui' => 0,
          'return_format' => 'value',
          'ajax' => 0,
          'placeholder' => '',
        ),
        array(
          'key' => 'field_5f2c6bc76d662',
          'label' => 'Duration (Seconds)',
          'name' => 'duration',
          'type' => 'number',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'default_value' => 20,
          'placeholder' => '',
          'prepend' => '',
          'append' => '',
          'min' => 1,
          'max' => '',
          'step' => '',
        ),
      ),
    ),
  ),
  'location' => array(
    array(
      array(
        'param' => 'options_page',
        'operator' => '==',
        'value' => 'acf-options-wall-api-config',
      ),
    ),
  ),
  'menu_order' => 0,
  'position' => 'normal',
  'style' => 'default',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => '',
  'active' => true,
  'description' => '',
));

endif;

$api_auth = array(
    'username' => 'unbridleddev',
    'password' => '@5#bKSANXw'
);
$api_auth_json = json_encode($api_auth);
// $endpoint = "https://sherilyn.unbridled.games/wp-json/jwt-auth/v1/token";
$ch = curl_init($api_endpoint);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $api_auth_json);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 42);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Accept: application/json',
    'Content-Type: application/json',
    'Content-Length: ' . strlen($api_auth_json))
);
$result = curl_exec($ch);
$token_result = json_decode($result);
$token = $token_result->token;

global $token;
$token = $token_result->token;

