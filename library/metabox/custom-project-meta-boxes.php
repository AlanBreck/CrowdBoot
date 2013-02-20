<?php
function cb_funding_goal_metaboxes( $meta_boxes ) {
	$prefix = '_cmb_'; // Prefix for all fields
	$meta_boxes[] = array(
		'id' => 'funding_goal',
		'title' => 'Funding Goal',
		'pages' => array('project'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Minimum Investment Amount',
				'id'   => $prefix . 'minimum_investment_amount',
				'type' => 'text_money',
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'cb_funding_goal_metaboxes' );

// Initialize the metabox class
add_action( 'init', 'cb_initialize_cmb_meta_boxes', 9999 );
function cb_initialize_cmb_meta_boxes() {
	if ( !class_exists( 'cmb_Meta_Box' ) ) {
		require_once( 'init.php' );
	}
}