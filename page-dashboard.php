<?php /*
Template Name: My Dashboard
*/ ?>
<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

				    <div id="main" class="twelvecol first clearfix" role="main">

					    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

						    <header class="article-header">

							    <h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>


						    </header> <!-- end article header -->

						    <section class="entry-content clearfix" itemprop="articleBody">
							    <?php the_content(); ?>

							    <?php if( is_user_logged_in() ) : ?>

							    	<?php $full_name = $current_user->user_firstname . '&nbsp;' . get_the_author_meta( 'middlename', $current_user->ID ) . '&nbsp;'  . $current_user->user_lastname; ?>

							    	<div id="hcard-<?php echo $current_user->user_firstname . '-' . $current_user->user_lastname; ?>" class="vcard clearfix">
							    		<img src="<?php get_gravatar_url( $user_email, 120 ); ?>" alt="<?php echo $full_name; ?>" class="photo" width="120" height="120" />
							    		<div class="account-details">
							    			<?php echo $full_name; ?>
							    			<span class="nickname"><?php echo $user_login; ?></span>
							    		</div>
							    	</div>

							    	<div class="my-projects-container">
							    		<h2>My Projects</h2>
										<?php $my_projects_loop = new WP_Query( array( 'post_type' => 'project', 'post_status' => 'any', 'author' => $current_user->ID ) ); ?>
							    		<?php if( $my_projects_loop->have_posts() ) : while( $my_projects_loop->have_posts() ) : $my_projects_loop->the_post() ?>

							    			<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
							    				<?php if ( get_post_status( get_the_ID() ) == 'pending' ) {
								    				echo '<strong>&mdash; Pending Review</strong>';
								    			} ?>
							    			</h3>

							    		<?php endwhile; else : ?>

							    			Sorry, you haven't created <strong>anything</strong> yet.

							    		<?php endif; ?>
							    		<?php wp_reset_postdata(); ?>
							    	</div>

							    <?php else : ?>

							    	<p>You didn't create an account yet? There are monkeys starving in Atlanta. <a href="<?php echo home_url( '/' ) ?>wp-register.php">Hop to it!</a></p>

							    <?php endif; ?>
							</section> <!-- end article section -->

						    <footer class="article-footer">

						    </footer> <!-- end article footer -->

					    </article> <!-- end article -->

					    <?php endwhile; else : ?>

    					    <article id="post-not-found" class="hentry clearfix">
    					    	<header class="article-header">
    					    		<h1><?php _e("Oops, Post Not Found!", "bonestheme"); ?></h1>
    					    	</header>
    					    	<section class="entry-content">
    					    		<p><?php _e("Uh Oh. Something is missing. Try double checking things.", "bonestheme"); ?></p>
    					    	</section>
    					    	<footer class="article-footer">
    					    	    <p><?php _e("This is the error message in the page.php template.", "bonestheme"); ?></p>
    					    	</footer>
    					    </article>

					    <?php endif; ?>

    				</div> <!-- end #main -->

				</div> <!-- end #inner-content -->

			</div> <!-- end #content -->

<?php get_footer(); ?>