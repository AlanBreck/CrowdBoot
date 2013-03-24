<?php
/*
Template Name: Create Project Script
*/
?>

<?php
	$project_post = array(
		'comment_status' => 'closed',
		'ping_status'    => 'closed',
		'post_author'    => $current_user->ID,
		'post_content'   => $_POST['post_content'],
		'post_excerpt'   => $_POST['post_excerpt'],
		'post_name'      => $_POST['post_title'],
		'post_title'     => wp_strip_all_tags( $_POST['post_title'] ),
		'post_type'      => 'project',
		'post_status'	 => 'publish'
	);

	$success = wp_insert_post( $project_post );

	if ( $success === 0 ) {
	  print "<meta http-equiv=\"refresh\" content=\"0;URL=you-are-dumb\">";
	}
	else {
	  print "<meta http-equiv=\"refresh\" content=\"0;URL=projects\">";
	}

?>