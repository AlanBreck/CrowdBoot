<?php
/*
Template Name: Project Creation Template
*/
?>
<?php
	if ( $_POST ) {
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

		$new_post = wp_insert_post( $project_post );

		add_post_meta( $new_post, '_cmb_min_funding_goal', $_POST['min_funding_goal'] );
		add_post_meta( $new_post, '_cmb_max_funding_goal', $_POST['max_funding_goal'] );

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

								<?php if ( is_user_logged_in() ) : ?>

									<form method="post">
										<input type="text" name="post_title" placeholder="Project Name" />
										<textarea type="text" name="post_content" placeholder="Description"></textarea>
										<textarea type="text" name="post_excerpt" placeholder="Short Description"></textarea>
										<input type="text" name="min_funding_goal" placeholder="Minimum Funding Goal" />
										<input type="text" name="max_funding_goal" placeholder="Maximum Funding Goal" />
										<input type="submit" value="Submit" />
									</form>

								<?php else : ?>

									<h2>Whoah!</h2>
									<p>Hold on there partner. You'll have to log in first. <?php wp_loginout(); ?></p>

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
