<?php
/*
Template Name: User Creation Template
*/
?>
<?php
	if ( $_POST ) {
		$new_user = array(
			'user_email'    => $_POST['user_email'],
			'user_login'    => $_POST['user_email'],
			'user_pass'     => $_POST['user_pass'],
			'first_name'    => $_POST['first_name'],
			'last_name'     => $_POST['last_name'],
			'user_url'      => $_POST['user_url'],
			'user_nicename' => $_POST['first_name'] . $_POST['last_name'],
			'rich_editing'  => false,
			'role'          => 'user'
		);

		$new_user = wp_insert_user( $new_user );

		header( "location: " . ( TRUE == $new_user ? '/log-in' : '/you-are-dumb' ) );
	}
?>
<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

				    <div id="main" class="eightcol first clearfix" role="main">

					    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

						    <section class="entry-content">

						    	<h2>Log In</h2>

						    	<?php
						    		if ( $_GET['back'] != '' ) {
						    			$redirect_url = $_GET['back'];
						    		} else {
						    			$redirect_url = site_url( 'get-started' );
						    		}
						    		if ( ! is_user_logged_in() ) { // Display WordPress login form:
						    		    $args = array(
						    		        'redirect' => $redirect_url,
						    		        'label_username' => __( 'Email' ),
						    		        'label_password' => __( 'Password' ),
						    		        'label_remember' => __( 'Remember Me' ),
						    		        'label_log_in' => __( 'Log In' ),
						    		        'remember' => true
						    		    );
						    		    wp_login_form( $args );
						    		} else { // If logged in:
						    		    echo "Awesome! You've already logged in!";
						    		}
						    	?>

						    	<h2>Register</h2>

								<?php if ( ! is_user_logged_in() ) : ?>

									<form method="post">
										<div>
											<input type="text" maxlength="20" name="user_email" placeholder="Email" />
											<input type="password" maxlength="20" name="user_pass" placeholder="Password" />
											<input type="password" maxlength="20" name="user_pass2" placeholder="Confirm Password" />
										</div>
										<div>
											<input type="submit" value="Submit" />
										</div>
									</form>

								<?php endif; ?>

						    </section> <!-- end article section -->

						    <footer class="article-footer">
						    </footer> <!-- end article footer -->

					    </article> <!-- end article -->

					    <?php endwhile; ?>

					    <?php else : ?>

        					<article id="post-not-found" class="hentry clearfix">
        					    <header class="article-header">
        						    <h1><?php _e("Oops, Post Not Found!", "bonestheme"); ?></h1>
        						</header>
        					    <section class="entry-content">
        						    <p><?php _e("Uh Oh. Something is missing. Try double checking things.", "bonestheme"); ?></p>
        						</section>
        						<footer class="article-footer">
        						    <p><?php _e("This is the error message in the page-custom.php template.", "bonestheme"); ?></p>
        						</footer>
        					</article>

					    <?php endif; ?>

				    </div> <!-- end #main -->

				    <?php get_sidebar(); ?>

				</div> <!-- end #inner-content -->

			</div> <!-- end #content -->

<?php get_footer(); ?>