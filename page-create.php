<?php
/*
Template Name: Project Creation Template
*/
?>
<?php
	if ( $_POST ) {
		$post_category = get_cat_ID( $_POST['post_category'] );
		$project_post = array(
			'comment_status' => 'closed',
			'ping_status'    => 'closed',
			'post_author'    => $current_user->ID,
			'post_content'   => $_POST['post_content'],
			'post_excerpt'   => $_POST['post_excerpt'],
			'post_name'      => $_POST['post_title'] . '-' . rand( 100, 999 ),
			'post_title'     => wp_strip_all_tags( $_POST['post_title'] ),
			'post_type'      => 'project',
			'post_status'	 => 'publish',
			'tags_input'	 => $_POST['tags_input']
		);

		$new_post = wp_insert_post( $project_post );

		wp_set_post_terms( $new_post, array( $post_category ), 'category' );

		add_post_meta( $new_post, '_cmb_min_funding_goal', preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $_POST['min_funding_goal'] ) );
		add_post_meta( $new_post, '_cmb_max_funding_goal', preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $_POST['max_funding_goal'] ) );
		add_post_meta( $new_post, '_cmb_minimum_investment_amount', $_POST['minimum_investment_amount'] );

		header( "location: " . ( TRUE == $new_post ? get_permalink( $new_post ) : 'you-are-dumb' ) );
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

								<?php if ( is_user_logged_in() && current_user_can( 'publish_projects' ) ) : ?>

									<form method="post">
										<div>
											<input type="text" name="post_title" placeholder="Project Name" />
										</div>
										<div>
											<textarea type="text" name="post_excerpt" placeholder="Short Description"></textarea>
										</div>
										<div>
											<textarea type="text" name="post_content" placeholder="Full Description"></textarea>
										</div>
										<div>
											<input type="text" name="min_funding_goal" maxlength="6" placeholder="Minimum Funding Goal" />
											<input type="text" name="max_funding_goal" maxlength="6" placeholder="Maximum Funding Goal" />
										</div>
										<div>
											<label for="minimum_investment_amount">Minimum Investment Amount</label>
											<select name="minimum_investment_amount" id="minimum_investment_amount">
												<option>--</option>
												<option value="$1 - $5">$1 - $5</option>
												<option value="$5 - $20">$5 - $20</option>
												<option value="$20 - $100">$20 - $100</option>
												<option value="$100 - $1,000">$100 - $1,000</option>
											</select>
										</div>
										<div>
											<label for="post_category">Project Category</label>
											<select name="post_category" id="post_category">
												<option>--</option>
												<option value="Culinary Arts">Culinary Arts</option>
												<option value="Education">Education</option>
												<option value="Finance">Finance</option>
												<option value="Hospitality">Hospitality</option>
												<option value="Media">Media</option>
												<option value="Real Estate">Real Estate</option>
												<option value="Software">Software</option>
												<option value="Product">Product</option>
												<option value="Tech">Tech</option>
												<option value="Hygiene">Hygiene</option>
												<option value="Furniture">Furniture</option>
												<option value="Decor">Decor</option>
												<option value="Service">Service</option>
												<option value="Manual Labor">Manual Labor</option>
												<option value="Software">Software</option>
												<option value="Charitable">Charitable</option>
												<option value="Boy Scout Projects">Boy Scout Projects</option>
												<option value="Science Fair Projects">Science Fair Projects</option>
											</select>
										</div>
										<div>
											<p>Please insert comma-separated list.</p>
											<input type="text" name="tags_input" placeholder="Tags" />
										</div>
										<div>
											<input type="submit" value="Submit" />
										</div>
									</form>

								<?php else : ?>

									<h2>Whoah!</h2>
									<p>Hold on there partner. You'll have to log in first.</p>

									<?php
										$args = array(
										    'redirect' => '/create-a-project',
										    'label_username' => __( 'Email' ),
										    'label_password' => __( 'Password' ),
										    'label_remember' => __( 'Remember Me' ),
										    'label_log_in' => __( 'Log In' ),
										    'remember' => true
										);
										wp_login_form( $args );
									?>

<<<<<<< HEAD
									<h3>Don't have an account?</h3>
									<a href="/new-user">Register</a>
=======
									<p>Don't have an account yet? The Monkey can help – <a href="http://dev.crowdboot.com/new-user/">Register</a></p>
>>>>>>> Changes as Per Max's Suggestions

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
