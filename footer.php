			<footer class="footer" role="contentinfo">

				<div id="inner-footer" class="wrap clearfix">

					<div class="left-footer-widgets footer-widgets first fourcol">
						<?php if ( is_active_sidebar( 'left_footer_widgets' ) ) : ?>

							<?php dynamic_sidebar( 'left_footer_widgets' ); ?>

						<?php else : ?>

							<!-- This content shows up if there are no widgets defined in the backend. -->

							<div class="alert help">
								<p><?php _e("Please activate some Widgets.", "bonestheme");  ?></p>
							</div>

						<?php endif; ?>
					</div>

					<div class="middle-footer-widgets footer-widgets fourcol">
						<?php if ( is_active_sidebar( 'middle_footer_widgets' ) ) : ?>

							<?php dynamic_sidebar( 'middle_footer_widgets' ); ?>

						<?php else : ?>

							<!-- This content shows up if there are no widgets defined in the backend. -->

							<div class="alert help">
								<p><?php _e("Please activate some Widgets.", "bonestheme");  ?></p>
							</div>

						<?php endif; ?>
					</div>

					<div class="right-footer-widgets footer-widgets last fourcol">
						<?php if ( is_active_sidebar( 'right_footer_widgets' ) ) : ?>

							<?php dynamic_sidebar( 'right_footer_widgets' ); ?>

						<?php else : ?>

							<!-- This content shows up if there are no widgets defined in the backend. -->

							<div class="alert help">
								<p><?php _e("Please activate some Widgets.", "bonestheme");  ?></p>
							</div>

						<?php endif; ?>
					</div>

					<?php /* ?><nav role="navigation">
    					<?php bones_footer_links(); ?>
	                </nav><?php */ ?>

					<p class="source-org copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.</p>

				</div> <!-- end #inner-footer -->

			</footer> <!-- end footer -->

		</div> <!-- end #container -->

		<!-- all js scripts are loaded in library/bones.php -->
		<?php wp_footer(); ?>

		<!-- FitVids.js -->
		<script>
			jQuery(document).ready(function(){
				jQuery(".entry-content").fitVids();
			});
		</script>

		<!-- Masonry.js -->
		<script>
			$(function(){

				if ( $("#main .project").length !== 0 ) {
				    toggleMasonry();

				    $(window).bind( 'resize', toggleMasonry );
				}

				function toggleMasonry( e ) {
					if ( $(document).width() > 767 ) {
						$('#main').masonry({
							// options
							itemSelector : '.project',
							columnWidth: function( containerWidth ) {
								return containerWidth / 3;
							},
							isAnimated : true
						}).addClass( 'masonry' ).children( 'article' ).addClass( 'masonry-brick' );
					} else {
						$( '#main' ).removeClass( 'masonry' ).children( 'article' ).removeClass( 'masonry-brick' );
					};
				}

			});
		</script>

	</body>

</html> <!-- end page. what a ride! -->
