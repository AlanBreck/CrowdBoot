<?php

// Add 'User' role with limited capabilities restricting them to edit 'Projects' alone.
add_action( 'after_switch_theme', 'add_user_role' );

function add_user_role() {
	add_role( 'user', 'User', array(
		'edit_projects'         => true,
		'edit_others_projects'  => false,
		'publish_projects'      => true,
		'read_private_projects' => true,
		'delete_projects'		=> true,
		'delete_others_projects'=> true
	));
}

// Give project editing capability to administrator role.
add_action( 'after_switch_theme', 'add_user_cap' );

function add_user_cap() {
	$role = get_role( 'administrator' );

	$role->add_cap( 'edit_projects' );
	$role->add_cap( 'edit_others_projects' );
	$role->add_cap( 'publish_projects' );
	$role->add_cap( 'read_private_project' );
}

// Grant meta capabilities on a per-post basis.
add_filter( 'map_meta_cap', 'my_map_meta_cap', 10, 4 );

function my_map_meta_cap( $caps, $cap, $user_id, $args ) {

	/* If editing, deleting, or reading a project, get the post and post type object. */
	if ( 'edit_project' == $cap || 'delete_project' == $cap || 'read_project' == $cap ) {
		$post = get_post( $args[0] );
		$post_type = get_post_type_object( $post->post_type );

		/* Set an empty array for the caps. */
		$caps = array();
	}

	/* If editing a project, assign the required capability. */
	if ( 'edit_project' == $cap ) {
		if ( $user_id == $post->post_author )
			$caps[] = $post_type->cap->edit_posts;
		else
			$caps[] = $post_type->cap->edit_others_posts;
	}

	/* If deleting a project, assign the required capability. */
	elseif ( 'delete_project' == $cap ) {
		if ( $user_id == $post->post_author )
			$caps[] = $post_type->cap->delete_posts;
		else
			$caps[] = $post_type->cap->delete_others_posts;
	}

	/* If reading a private project, assign the required capability. */
	elseif ( 'read_project' == $cap ) {

		if ( 'private' != $post->post_status )
			$caps[] = 'read';
		elseif ( $user_id == $post->post_author )
			$caps[] = 'read';
		else
			$caps[] = $post_type->cap->read_private_posts;
	}

	/* Return the capabilities required by the user. */
	return $caps;
}

?>