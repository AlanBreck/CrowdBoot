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

		header( "location: " . ( TRUE == $new_user ? '/log-in/?redirect_to=' . $_GET['redirect_to'] . '&new_registration=true'  : '/you-are-dumb' ) );
	}
?>
<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

				    <div id="main" class="eightcol first clearfix" role="main">

					    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

						    <section class="entry-content">

						    	<?php if ( $_GET['new_registration'] === 'true' ) : ?>
									<p>Congratulations! Your account has been created! Please log in below.</p>
						    	<?php elseif ( $_GET['intent'] === 'create_project' ) : ?>
									<p>Please log in to create a new project.</p>
						    	<?php endif; ?>

						    	<div id="login" class="sixcol first">
						    		<h2>Log In</h2>

						    		<?php
						    			if ( $_GET['redirect_to'] != '' ) {
						    				$redirect_url = $_GET['redirect_to'];
						    			} else {
						    				$redirect_url = site_url();
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
						    	</div>

						    	<div id="register" class="sixcol last">
						    		<h2>Register</h2>

									<?php if ( ! is_user_logged_in() ) : ?>

										<form method="post">
											<div>
												<!-- <input type="hidden" name="redirect_to" id="redirect_to" value="<?php echo $_GET['redirect_to']; ?>" /> -->
												<input type="email" maxlength="100" name="user_email" placeholder="Email" required />
												<input type="password" maxlength="20" name="user_pass" id="user_pass" placeholder="Password" required />
												<input type="password" maxlength="20" name="user_pass2" id="user_pass2" placeholder="Confirm Password" required />
												<script type="text/javascript">
													$("#user_pass2").on("change blur", function () {
													    if ( $(this).val() !== $("#user_pass").val() ) {
													        alert( "Your passwords don't match.");
													    }
													});
												</script>
											</div>
											<div>
												<input type="submit" value="Submit" />
											</div>
										</form>

									<?php endif; ?>
								</div>

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

				</div> <!-- end #inner-content -->

			</div> <!-- end #content -->

<?php get_footer(); ?>