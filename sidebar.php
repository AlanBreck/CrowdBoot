				<div id="sidebar1" class="sidebar fourcol last clearfix" role="complementary">

					<?php if ( is_singular( 'project' ) ) : ?>
						<div class="widget">
							<h4 class="widgettitle">Make Donation</h4>
							<?php if ( is_user_logged_in() ) : ?>
								<script src="<?php echo get_stylesheet_directory_uri(); ?>/library/js/paypal-button.min.js?merchant=badams@crowdboot.com"
								    data-button="donate"
								    data-amount-editable=""
								    data-number="<?php echo $post->ID; ?>"
								    data-name="<?php echo convert_smart_quotes( get_the_title( $post->ID ) ); ?>"
								    data-callback="<?php echo get_permalink( $post->ID ); ?>"
								    data-env="sandbox"
								></script>
							<?php else : ?>
								<form method="get" action="<?php echo site_url( 'log-in' ) ?>">
									<input type="hidden" name="back" value="<?php echo get_permalink(); ?>" />
									<button type="submit">Log In to Donate</button>
								</form>
							<?php endif; ?>
						</div>
					<?php endif; ?>

					<?php if ( is_active_sidebar( 'sidebar' ) ) : ?>

						<?php dynamic_sidebar( 'sidebar' ); ?>

					<?php else : ?>

						<!-- This content shows up if there are no widgets defined in the backend. -->

						<div class="alert help">
							<p><?php _e("Please activate some Widgets.", "bonestheme");  ?></p>
						</div>

					<?php endif; ?>

				</div>