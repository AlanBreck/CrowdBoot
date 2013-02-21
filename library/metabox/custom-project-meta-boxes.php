<?php
function cb_metaboxes( $meta_boxes ) {
	$prefix = '_cmb_'; // Prefix for all fields
	$meta_boxes[] = array(
		'id' => 'funding_goals',
		'title' => 'Funding Goals',
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
			array(
				'name' => 'Funding Goal Range',
				'id'   => $prefix . 'funding_goal_range',
				'type' => 'select',
				'options' => array(
					array('name' => '$100 - $1,000', 'value' => '$100 - $1,000'),
					array('name' => '$1,000 - $10,000', 'value' => '$1,000 - $10,000'),
					array('name' => '$10,000 - $100,000', 'value' => '$10,000 - $100,000')
				)
			)
		),
	);

	$meta_boxes[] = array(
		'id' => 'promotional_media',
		'title' => 'Promotional Media',
		'pages' => array('project'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Promotional Video',
				'desc' => 'Enter a YouTube or Vimeo video URL.',
				'id'   => $prefix . 'promotional_video',
				'type' => 'oembed'
			)
		)
	);

	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'cb_metaboxes' );

// Initialize the metabox class
add_action( 'init', 'cb_initialize_cmb_meta_boxes', 9999 );
function cb_initialize_cmb_meta_boxes() {
	if ( !class_exists( 'cmb_Meta_Box' ) ) {
		require_once( 'init.php' );
	}
}
