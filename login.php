<h2>Whoah!</h2>
<p>Hold on there partner. You'll have to log in first.</p>

<?php
	$args = array(
	    'redirect' => site_url( '/create-a-project/' ),
	    'label_username' => __( 'Email' ),
	    'label_password' => __( 'Password' ),
	    'label_remember' => __( 'Remember Me' ),
	    'label_log_in' => __( 'Log In' ),
	    'remember' => true
	);
	wp_login_form( $args );
?>

<h3>Don't have an account?</h3>
<a href="/new-user">Register</a>
<p>Don't have an account yet? The Monkey can help – <a href="http://dev.crowdboot.com/new-user/">Register</a></p>