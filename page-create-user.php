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

		/*header( "location: " . ( TRUE == $new_user ? get_permalink( $new_user ) : 'you-are-dumb' ) );*/
	}
?>
<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

				    <div id="main" class="eightcol first clearfix" role="main">

					    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

						    <header class="article-header">

							    <h1 class="page-title"><?php the_title(); ?></h1>

						    </header> <!-- end article header -->

						    <section class="entry-content">

								<?php if ( ! is_user_logged_in() ) : ?>

									<form method="post">
										<div>
											<input type="text" name="first_name" placeholder="First Name" />
											<input type="text" name="last_name" placeholder="Last Name" />
										</div>
										<div>
											<input type="text" name="user_email" placeholder="Email" />
											<input type="text" name="user_pass" placeholder="Password" />
											<input type="text" name="user_pass2" placeholder="Confirm Password" />
										</div>
										<div>
											<input type="text" name="user_url" placeholder="Website" />
										</div>
										<div>
											<input type="radio" name="post_category" id="option1" value="Culinary Arts" />
											<label for="option1">Culinary Arts</label>
											<br/>
											<input type="radio" name="post_category" id="option2" value="Education" />
											<label for="option2">Education</label>
											<br/>
											<input type="radio" name="post_category" id="option3" value="Finance" />
											<label for="option3">Finance</label>
											<br/>
											<input type="radio" name="post_category" id="option4" value="Hospitality" />
											<label for="option4">Hospitality</label>
											<br/>
											<input type="radio" name="post_category" id="option5" value="Law" />
											<label for="option5">Law</label>
											<br/>
											<input type="radio" name="post_category" id="option6" value="Media" />
											<label for="option6">Media</label>
											<br/>
											<input type="radio" name="post_category" id="option7" value="News" />
											<label for="option7">News</label>
											<br/>
											<input type="radio" name="post_category" id="option8" value="Real Estate" />
											<label for="option8">Real Estate</label>
											<br/>
											<input type="radio" name="post_category" id="option9" value="Software" />
											<label for="option9">Software</label>
										</div>
										<div>
											<input type="submit" value="Submit" />
										</div>
									</form>

								<?php else : ?>

									<h2>Hey!</h2>
									<p>You already have an account. Silly little person.</p>

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
