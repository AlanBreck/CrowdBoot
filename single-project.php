<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

					<div id="main" class="eightcol first clearfix" role="main">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">

									<h1 class="entry-title single-title" itemprop="headline"><?php the_title(); ?></h1>
                 					<p class="byline vcard"><?php printf(__('Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span> <span class="amp">&amp;</span> filed under %4$s.', 'bonestheme'), get_the_time('Y-m-j'), get_the_time(__('F js, Y', 'bonestheme')), bones_get_the_author_posts_link(), get_the_category_list(', ')); ?></p>

								</header> <!-- end article header -->

								<section class="entry-content clearfix" itemprop="articleBody">
									<?php
										global $post;
										if ( get_post_meta( $post->ID, '_cmb_min_funding_goal', true ) && get_post_meta( $post->ID, '_cmb_min_funding_goal', true ) ) {
											$funding_goal_range = '$' . get_post_meta( $post->ID, '_cmb_min_funding_goal', true ) . ' - $' . get_post_meta( $post->ID, '_cmb_max_funding_goal', true );
										} else {
											$funding_goal_range = 'To Be Determined';
										}
									?>
									<p>Funding Goal Range: <strong><?php echo $funding_goal_range; ?></strong></p>
									<?php
										global $post;
										if ( get_post_meta( $post->ID, '_cmb_minimum_investment_amount', true ) ) {
											$minimum_investment_amount = get_post_meta( $post->ID, '_cmb_minimum_investment_amount', true );
										} else {
											$minimum_investment_amount = 'To Be Determined';
										}
									?>
									<p>Minimum Investment Amount: <strong><?php echo $minimum_investment_amount; ?></strong></p>
									<?php the_content(); ?>
									<?php echo apply_filters( 'the_content', get_post_meta( $post->ID, '_cmb_promotional_video', true ) ); ?>
									<?php if ( get_post_meta( $post->ID, '_cmb_promotional_images', true ) ) {
										$promotional_images = get_post_meta( $post->ID, '_cmb_promotional_images', true );
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
