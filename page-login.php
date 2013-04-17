<?php
/*
Template Name: Login Page
*/
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

							<?php
								if ( ! is_user_logged_in() ) { // Display WordPress login form:
								    $args = array(
								        'redirect' => '/create-a-project',
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
