<?php global $post; get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

					<div id="main" class="eightcol first clearfix" role="main">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

						<?php $project_meta = get_post_meta( get_the_ID(), 'project_meta', true ); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<?php if ( get_post_status( get_the_ID() ) == 'pending' ) : ?>

									<p class="success-alert alert">You're project was succesfully submitted! It will now be reviewed by our team. We'll notify you if we have any questions or once it's approved.</p>

								<?php endif; ?>

								<header class="article-header">

									<h1 class="entry-title single-title" itemprop="headline"><?php the_title(); ?></h1><?php if ( is_user_logged_in() && current_user_can( 'edit_projects' ) ) { echo '<a href="' . site_url( 'edit/' ) . '?ID=' . get_the_ID() . '" class="edit-project-link">Edit Project</a>'; } ?>
                 					<p class="byline vcard"><?php printf(__('Created <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span> <span class="amp">&amp;</span> filed under %4$s.', 'bonestheme'), get_the_time('Y-m-j'), get_the_time(__(get_option('date_format'), 'bonestheme')), bones_get_the_author_posts_link(), get_the_category_list(', ')); ?></p>

								</header> <!-- end article header -->

								<section class="entry-content clearfix" itemprop="articleBody">
									<?php
										if ( $project_meta['min_funding_goal'] && $project_meta['min_funding_goal'] ) {
											$funding_goal_range = '$' . $project_meta['min_funding_goal']/* . ' - $' . $project_meta['max_funding_goal']*/;
										} else {
											$funding_goal_range = 'To Be Determined';
										}
									?>
									<p>Funding Goal: <strong><?php echo $funding_goal_range; ?></strong></p>
									<?php
										if ( $project_meta['minimum_investment_amount'] ) {
											$minimum_investment_amount = $project_meta['minimum_investment_amount'];
										} else {
											$minimum_investment_amount = 'To Be Determined';
										}
									?>
									<?php /* ?><p>Minimum Investment Amount: <strong><?php echo $minimum_investment_amount; ?></strong></p><?php */ ?>
									<?php the_content(); ?>
									<?php echo apply_filters( 'the_content', $project_meta['promotional_video'] ); ?>
									<?php if ( $project_meta['promotional_images'] ) {
										$promotional_images = $project_meta['promotional_images'];
										echo '<img src="' . $promotional_images . '" />';
									} ?>
								</section> <!-- end article section -->

								<footer class="article-footer">
									<?php the_tags('<p class="tags"><span class="tags-title">' . __('Tags:', 'bonestheme') . '</span> ', ', ', '</p>'); ?>

								</footer> <!-- end article footer -->

								<?php /* comments_template(); */ ?>

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
					    		    <p><?php _e("This is the error message in the single.php template.", "bonestheme"); ?></p>
					    		</footer>
							</article>

						<?php endif; ?>

					</div> <!-- end #main -->

					<?php get_sidebar(); ?>

				</div> <!-- end #inner-content -->

			</div> <!-- end #content -->

<?php get_footer(); ?>
