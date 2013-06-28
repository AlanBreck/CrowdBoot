<?php
/*
Template Name: User Creation Template
*/
?>
<?php
	if ( $_POST ) {
		$user_nicename = $_POST['user_organization'] ? $_POST['user_organization'] : $_POST['user_first_name'] . '-' . $_POST['user_last_name'];
		$display_name = $_POST['user_organization'] ? $_POST['user_organization'] : $_POST['user_first_name'] . ' ' . $_POST['user_last_name'];
		$new_user = array(
			'user_email'    => $_POST['user_email'],
			'user_login'    => $_POST['user_email'],
			'user_pass'     => $_POST['user_pass'],
			'first_name'	=> $_POST['user_first_name'],
			'last_name'		=> $_POST['user_last_name'],
			'user_nicename'	=> strtolower( $user_nicename ),
			'display_name'	=> $display_name,
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

				    <div id="main" class="clearfix" role="main">

					    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

						    <section class="entry-content clearfix">

						    	<?php if ( $_GET['new_registration'] === 'true' ) : ?>
									<p class="success-alert alert">Congratulations! Your account has been created! Please log in below.</p>
						    	<?php elseif ( $_GET['intent'] === 'create_project' ) : ?>
									<p class="alert">Please log in to create a new project.</p>
						    	<?php endif; ?>

						    	<div id="login" class="sixcol first">
						    		<h2>Log In</h2>

						    		<?php
						    			if ( $_GET['redirect_to'] != '' ) {
						    				$redirect_url = $_GET['redirect_to'];
						    			} else {
						    				$redirect_url = site_url( "/projects" );
						    			}
						    			if ( ! is_user_logged_in() ) : ?>

						    			    <form name="loginform" id="loginform" action="<?php echo site_url(); ?>/wp-login.php" method="post">

				    			    			<p class="login-username">
				    			    				<input type="text" name="log" id="user_login" class="input" placeholder="Email" value="" size="20" />
				    			    			</p>
				    			    			<p class="login-password">
				    			    				<input type="password" name="pwd" id="user_pass" class="input" placeholder="Password" value="" size="20" />
				    			    			</p>

				    			    			<p class="login-remember"><label><input name="rememberme" type="checkbox" id="rememberme" value="forever" /> Remember Me</label></p>
				    			    			<p class="login-submit">
				    			    				<input type="submit" name="wp-submit" id="wp-submit" class="button-primary" value="Log In" />
				    			    				<input type="hidden" name="redirect_to" value="<?php echo $redirect_url; ?>" />
				    			    			</p>

				    			    		</form>

						    			<?php else : // If logged in:
						    			    echo "You've already logged in! Awesome!";
						    			endif;
						    		?>
						    	</div>

						    	<div id="register" class="sixcol last">
						    		<h2>Register</h2>

									<?php if ( ! is_user_logged_in() ) : ?>

										<form method="post">
											<div>
												<input type="hidden" name="redirect_to" id="redirect_to" value="<?php echo $_GET['redirect_to']; ?>" />
												<div>
													<input class="first-name" type="text" maxlength="100" name="user_first_name" placeholder="First Name" required />
													<input class="last-name" type="text" maxlength="100" name="user_last_name" placeholder="Last Name" required />
												</div>
												<div>
													<input type="text" maxlength="100" name="user_organization" placeholder="Organization (optional)" />
												</div>
												<div>
													<input type="email" maxlength="100" name="user_email" placeholder="Email" required />
												</div>
												<div>
													<input type="password" maxlength="20" name="user_pass" id="registration_pass" placeholder="Password" required />
												</div>
												<div>
													<input type="password" maxlength="20" name="user_pass2" id="registration_pass2" placeholder="Confirm Password" required />
												</div>
												<script type="text/javascript">
													$(function(){
														$("#registration_pass2").on("change blur", function () {
														    if ( $(this).val() !== $("#registration_pass").val() ) {
														        alert( "Your passwords don't match.");
														    }
														});
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