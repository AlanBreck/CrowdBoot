<?php
/*
Page Template: Geting Started Page
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

								<?php if ( ! is_user_logged_in() ) : ?>

									<?php the_content(); ?>

								<?php else : ?>

									<script src="<?php echo get_stylesheet_directory_uri(); ?>/library/js/paypal-button.min.js?merchant=badams@crowdboot.com"
									    data-button="donate"
									    data-amount-editable=""
									    data-quantity-editable=""
									    data-number="<?php $_GET['ProjectID']; ?>"
									    data-name="<?php $_GET['ProjectName']; ?>"
									    data-callback="<?php $_GET['ProjectURL']; ?>"
									    data-env="sandbox"
									></script>

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

				</div> <!-- end #inner-content -->

			</div> <!-- end #content -->

<?php get_footer(); ?>