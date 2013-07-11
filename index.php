<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

				    <div id="main" class="clearfix" role="main">
				    	<?php $isProjectsPage = is_page( 'projects' ); ?>

						<?php $i = 1; ?>

						<?php $project_loop = new WP_Query( array( 'post_type' => 'project' ) ); ?>
					    <?php if ( $project_loop->have_posts() ) : while ( $project_loop->have_posts() ) : $project_loop->the_post(); ?>

					    <?php
					    	$firstOrLast = $i === 1 ? 'first' : ( $i === 3 ? 'last' : '' );
					    	$project_meta = get_post_meta( get_the_ID(), 'project_meta', true );
					    ?>

						<?php $classes = array( 'clearfix', 'fourcol', $firstOrLast ); ?>
					    <article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?> role="article">

						    <header class="article-header">

							    <h1 class="h2"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
                  				<p class="byline vcard"><?php printf(__('Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span> <span class="amp">&</span> filed under %4$s.', 'bonestheme'), get_the_time('Y-m-j'), get_the_time(get_option('date_format')), bones_get_the_author_posts_link(), get_the_category_list(', ')); ?></p>

						    </header> <!-- end article header -->

						    <section class="entry-content clearfix">
							    <?php the_excerpt(); ?>
							    <?php
							    	global $post;
							    	if ( $project_meta['min_funding_goal'] && $project_meta['min_funding_goal'] ) {
							    		$funding_goal_range = '$' . $project_meta['min_funding_goal'];
							    		/*$funding_goal_range = '$' . $project_meta['min_funding_goal'] . ' - $' . $project_meta['max_funding_goal'];*/
							    	} else {
							    		$funding_goal_range = 'To Be Determined';
							    	}
							    ?>
							    <p>Funding Goal: <strong><?php echo $funding_goal_range; ?></strong></p>
							    <?php
							    	global $post;
							    	if ( $project_meta['minimum_investment_amount'] ) {
							    		$minimum_investment_amount = $project_meta['minimum_investment_amount'];
							    	} else {
							    		$minimum_investment_amount = 'To Be Determined';
							    	}
							    ?>
						    </section> <!-- end article section -->

						    <footer class="article-footer">
    							<p class="tags"><?php the_tags('<span class="tags-title">' . __('Tags:', 'bonestheme') . '</span> ', ', ', ''); ?></p>

						    </footer> <!-- end article footer -->

						    <?php // comments_template(); // uncomment if you want to use them ?>

					    </article> <!-- end article -->

					    <?php $i++; if( $i > 3) : ?>
					    	<div class="clear"></div>
					    <?php $i = 1; endif; endwhile; ?>

					        <?php if (function_exists('bones_page_navi')) { ?>
					            <?php bones_page_navi(); ?>
					        <?php } else { ?>
					            <nav class="wp-prev-next">
					                <ul class="clearfix">
					        	        <li class="prev-link"><?php next_posts_link(__('&laquo; Older Entries', "bonestheme")) ?></li>
					        	        <li class="next-link"><?php previous_posts_link(__('Newer Entries &raquo;', "bonestheme")) ?></li>
					                </ul>
					            </nav>
					        <?php } ?>

					    <?php else : ?>

					        <article id="post-not-found" class="hentry clearfix">
					            <header class="article-header">
					        	    <h1><?php _e("Oops, Post Not Found!", "bonestheme"); ?></h1>
					        	</header>
					            <section class="entry-content">
					        	    <p><?php _e("Uh Oh. Something is missing. Try double checking things.", "bonestheme"); ?></p>
					        	</section>
					        	<footer class="article-footer">
					        	    <p><?php _e("This is the error message in the index.php template.", "bonestheme"); ?></p>
					        	</footer>
					        </article>

					    <?php endif; ?>
					    <?php wp_reset_postdata(); ?>

				    </div> <!-- end #main -->

				</div> <!-- end #inner-content -->

			</div> <!-- end #content -->

<?php get_footer(); ?>
