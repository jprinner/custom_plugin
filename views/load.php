<?php
//Load templates
	//Load archive templates
	// add_filter( 'archive_template', 'get_custom_archive_templates' ) ;
	// function get_custom_archive_templates( $archive_template ) {
	// 	 global $post;
	// 	 if ( is_post_type_archive ( 'CUSTOM-POST-TYPE' ) ) {
	// 		  $archive_template = dirname( __FILE__ ) . '/archive-CUSTOM-POST-TYPE.php';
	// 	 }
	// 	 return $archive_template;
	// }
	// //Load single templates
	// add_filter( 'single_template', 'get_custom_single_templates' );
	// function get_custom_single_templates($single_template) {
	// 	global $post;
	// 	 if ($post->post_type == 'CUSTOM-POST-TYPE') {
	// 		 $single_template = dirname( __FILE__ ) . '/single-CUSTOM-POST-TYPE.php';
	// 	 }
	// 	 return $single_template;
	// }
	// //Load specific pages
	// add_filter( 'template_include', 'get_custom_page_templates', 99 );
	// function get_custom_page_templates( $template ) {
	// 	if ( is_page( 'CUSTOM-PAGE-TEMPLATE' ) ) {
	// 		$new_template = dirname( __FILE__ ) . '/CUSTOM-PAGE-TEMPLATE.php';
	// 		if ( !empty( $new_template ) ) {
	// 			return $new_template;
	// 		}
	// 	}
	// 	return $template;
	// }
