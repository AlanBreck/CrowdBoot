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

							    	<p>You're awesome cuz you created an account.</p>

							    	<a href="<?php echo admin_url( 'profile.php' ); ?>">Edit Profile</a>

							    	<div id="hcard-<?php echo $current_user->user_firstname . '-' . $current_user->user_lastname; ?>" class="vcard">
							    		<img src="<?php get_gravatar_url( $user_email, 120 ); ?>" alt="<?php echo $full_name; ?>" class="photo" width="120" height="120" />
							    		<div class="account-details">
							    			<a href="<?php echo $user_url; ?>" class="fn url"><?php echo $full_name; ?></a>
							    			<span class="nickname"><?php echo $user_login; ?></span>
							    			<span class="email"><?php echo $user_email; ?></span>
							    			<span class="tel"><?php the_author_meta( 'phonenumber', $current_user->ID ) ?></span>
							    			<span class="title"><?php the_author_meta( 'occupation', $current_user->ID ) ?></span>
							    			<p class="bold">Bio</p>
							    			<p class="bio"><?php echo the_author_meta( 'description', $current_user->ID ) ?></p>
							    			<p class="bold">Interests</p>
							    			<p class="interests">
						    				<?php
						    					$interests = get_the_author_meta( 'interests', $current_user->ID );
						    					echo $interests;
						    				?>
							    			</p>
							    		</div>
							    	</div>

							    	<div class="interests-loop">
							    		<?php $interests_array = explode( ', ', $interests ); ?>
										<?php $interests_loop = new WP_Query( 'post_type=project' ); ?>
							    		<?php if( $interests_loop->have_posts() ) : while( $interests_loop->have_posts() ) : $interests_loop->the_post() ?>

							    			<h3><?php the_title(); ?></h3>

							    		<?php endwhile; else : ?>

							    			Sorry, there's just <strong>nothing</strong> here that'll interest you.

							    		<?php endif; ?>
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