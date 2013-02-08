<?php

add_action( 'show_user_profile', 'show_crowdboot_profile_fields' );
add_action( 'edit_user_profile', 'show_crowdboot_profile_fields' );

function show_crowdboot_profile_fields( $user ) { ?>

	<h3>Extra profile information</h3>

	<table class="form-table">

		<tr>
			<th><label for="middlename">Middle Name</label></th>

			<td>
				<input type="text" name="middlename" id="middlename" value="<?php echo esc_attr( get_the_author_meta( 'middlename', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your middle name.</span>
			</td>
		</tr>
		<tr>
			<th><label for="phonenumber">Phone Number</label></th>

			<td>
				<input type="text" name="phonenumber" id="phonenumber" value="<?php echo esc_attr( get_the_author_meta( 'phonenumber', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your phone number.</span>
			</td>
		</tr>
		<tr>
			<th><label for="occupation">Occupation</label></th>

			<td>
				<input type="text" name="occupation" id="occupation" value="<?php echo esc_attr( get_the_author_meta( 'occupation', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your occupation.</span>
			</td>
		</tr>
		<tr>
			<th><label for="interests">Interests</label></th>

			<td>
				<input type="text" name="interests" id="interests" value="<?php echo esc_attr( get_the_author_meta( 'interests', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your interests (separated by comma).</span>
			</td>
		</tr>

	</table>
<?php }

add_action( 'personal_options_update', 'save_crowdboot_profile_fields' );
add_action( 'edit_user_profile_update', 'save_crowdboot_profile_fields' );

function save_crowdboot_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	update_usermeta( $user_id, 'middlename', $_POST['middlename'] );
	update_usermeta( $user_id, 'phonenumber', $_POST['phonenumber'] );
	update_usermeta( $user_id, 'occupation', $_POST['occupation'] );
	update_usermeta( $user_id, 'interests', $_POST['interests'] );
}

?>