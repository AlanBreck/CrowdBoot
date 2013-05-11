<?php
function cb_metaboxes( $meta_boxes ) {

	$prefix = '_cmb_'; // Prefix for all fields

	$meta_boxes[] = array(
		'id' => 'category',
		'title' => 'Category',
		'pages' => array('project'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => false, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Category',
				'desc' => 'Select the category in which your business would best fit.',
				'id' => $prefix . 'category',
				'taxonomy' => 'category',
				'type' => 'taxonomy_radio',
			)
		)
	);

	$meta_boxes[] = array(
		'id' => 'funding_goals',
		'title' => 'Funding Goals',
		'pages' => array('project'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Minimum Funding Goal',
				'id'   => $prefix . 'min_funding_goal',
				'type' => 'text_money',
			),
			array(
				'name' => 'Maximum Funding Goal',
				'id'   => $prefix . 'max_funding_goal',
				'type' => 'text_money',
			),
			array(
				'name' => 'Minimum Investment Amount',
				'id'   => $prefix . 'minimum_investment_amount',
				'type' => 'select',
				'options' => array(
					array('name' => '$1 - $5', 'value' => '$1 - $5'),
					array('name' => '$5 - $20', 'value' => '$5 - $20'),
					array('name' => '$20 - $100', 'value' => '$20 - $100'),
					array('name' => '$100 - $1,000', 'value' => '$100 - $1,000')
				)
			)
		),
	);

	$meta_boxes[] = array(
		'id' => 'tax_deductible_info',
		'title' => 'Tax Deductible',
		'pages' => array('project'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Are donations to your organization, and this project, tax deductible?',
				'id' => $prefix . 'tax_deductible',
				'type' => 'radio_inline',
				'options' => array(
					array('name' => 'Yes', 'value' => 'true'),
					array('name' => 'No', 'value' => 'false' ),
				)
			),
			array(
				'name' => 'EIN',
				'id' => $prefix . 'irs_ein',
				'type' => 'text'
			),
			array(
				'name' => 'Name',
				'id' => $prefix . 'name',
				'type' => 'text'
			),
			array(
				'name' => 'City',
				'id' => $prefix . 'city',
				'type' => 'text'
			),
			array(
				'name' => 'State',
				'id' => $prefix . 'state',
				'type' => 'text'
			),
			array(
				'name' => 'Country',
				'id' => $prefix . 'country',
				'type' => 'select',
				'options' => array(
					array('name' => 'Select a State', 'value' => ''),
					array('name' => 'Alabama', 'value' => 'AL'),
					array('name' => 'Alaska', 'value' => 'AK'),
					array('name' => 'Arizona', 'value' => 'AZ'),
					array('name' => 'Arkansas', 'value' => 'AR'),
					array('name' => 'California', 'value' => 'CA'),
					array('name' => 'Colorado', 'value' => 'CO'),
					array('name' => 'Connecticut', 'value' => 'CT'),
					array('name' => 'Delaware', 'value' => 'DE'),
					array('name' => 'District', 'value' => 'DC'),
					array('name' => 'Florida', 'value' => 'FL'),
					array('name' => 'Georgia', 'value' => 'GA'),
					array('name' => 'Hawaii', 'value' => 'HI'),
					array('name' => 'Idaho', 'value' => 'ID'),
					array('name' => 'Illinois', 'value' => 'IL'),
					array('name' => 'Indiana', 'value' => 'IN'),
					array('name' => 'Iowa', 'value' => 'IA'),
					array('name' => 'Kansas', 'value' => 'KS'),
					array('name' => 'Kentucky', 'value' => 'KY'),
					array('name' => 'Louisiana', 'value' => 'LA'),
					array('name' => 'Maine', 'value' => 'ME'),
					array('name' => 'Maryland', 'value' => 'MD'),
					array('name' => 'Massachusetts', 'value' => 'MA'),
					array('name' => 'Michigan', 'value' => 'MI'),
					array('name' => 'Minnesota', 'value' => 'MN'),
					array('name' => 'Mississippi', 'value' => 'MS'),
					array('name' => 'Missouri', 'value' => 'MO'),
					array('name' => 'Montana', 'value' => 'MT'),
					array('name' => 'Nebraska', 'value' => 'NE'),
					array('name' => 'Nevada', 'value' => 'NV'),
					array('name' => 'New', 'value' => 'NH'),
					array('name' => 'New', 'value' => 'NJ'),
					array('name' => 'New', 'value' => 'NM'),
					array('name' => 'New', 'value' => 'NY'),
					array('name' => 'North', 'value' => 'NC'),
					array('name' => 'North', 'value' => 'ND'),
					array('name' => 'Ohio', 'value' => 'OH'),
					array('name' => 'Oklahoma', 'value' => 'OK'),
					array('name' => 'Oregon', 'value' => 'OR'),
					array('name' => 'Pennsylvania', 'value' => 'PA'),
					array('name' => 'Rhode', 'value' => 'RI'),
					array('name' => 'South', 'value' => 'SC'),
					array('name' => 'South', 'value' => 'SD'),
					array('name' => 'Tennessee', 'value' => 'TN'),
					array('name' => 'Texas', 'value' => 'TX'),
					array('name' => 'Utah', 'value' => 'UT'),
					array('name' => 'Vermont', 'value' => 'VT'),
					array('name' => 'Virginia', 'value' => 'VA'),
					array('name' => 'Washington', 'value' => 'WA'),
					array('name' => 'West', 'value' => 'WV'),
					array('name' => 'Wisconsin', 'value' => 'WI'),
					array('name' => 'Wyoming', 'value' => 'WY')
				)
			)
		)
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
			),
			array(
				'name' => 'Promotional Images',
				'desc' => 'Upload images or type in URL.',
				'id'   => $prefix . 'promotional_images',
				'type' => 'file_list'
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
