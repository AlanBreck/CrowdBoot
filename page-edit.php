<?php
/*
Template Name: Project Editor Template
*/
?>
<?php

	if ( ! is_user_logged_in() ) {
		header( "location: " . site_url( 'log-in' ) . '/?redirect_to=' . get_permalink() . '&intent=create_project' );
	}

	if ( $_POST ) {
		$project_post_edits = array();
		$project_post_edits['ID']           = $_GET['ID'];
		$project_post_edits['post_content'] = $_POST['post_content'];
		$project_post_edits['post_excerpt'] = $_POST['post_excerpt'];
		$project_post_edits['post_title']   = $_POST['post_title'];
		$project_post_edits['post_name']    = $_POST['post_title'];
		$project_post_edits['tags_input']   = $_POST['tags_input'];

		$updated_project = wp_update_post( $project_post_edits );

		wp_set_post_terms( $updated_project, $_POST['post_category'], 'category' );

		update_post_meta( $updated_project, 'project_meta', $_POST['project_meta'] );

		header( "location: " . ( TRUE == $updated_project ? get_permalink( $updated_project ) : 'you-are-dumb' ) );
	}
?>
<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

				    <div id="main" class="eightcol first clearfix" role="main">

					    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

					    	<?php $original_project = get_post( $_GET['ID'], ARRAY_A ); ?>
					    	<?php $original_project_meta = get_post_meta( $original_project['ID'], 'project_meta', true ); ?>

						    <header class="article-header">

							    <h1 class="page-title"><?php the_title(); echo ' "' . $original_project['post_title'] . '"'; ?></h1>

						    </header> <!-- end article header -->

						    <section class="entry-content">

								<?php if ( is_user_logged_in() && current_user_can( 'edit_projects' ) ) : ?>

									<form method="post">
										<div class="project-name">
											<input type="text" name="post_title" value="<?php echo $original_project['post_title']; ?>" placeholder="Project Name *" required />
										</div>
										<div>
											<textarea type="text" name="post_excerpt" rows="4" placeholder="Elevator Pitch *" required><?php echo $original_project['post_excerpt']; ?></textarea>
										</div>
										<div>
											<textarea type="text" name="post_content" rows="7" placeholder="Full Description"><?php echo $original_project['post_content']; ?></textarea>
										</div>
										<div>
											<select name="post_category" id="post_category" class="project-category" required>
												<option disabled>Project Category *</option>
												<?php
													$categories = get_categories( array( 'orderby' => 'slug', 'hide_empty' => 0 ));
													foreach ( $categories as $category ) {
														$selected = in_category( $category->slug, $original_project['ID'] ) ? 'selected' : '';?>
														<option value="<?php echo $category->cat_ID; ?>" <?php echo $selected; ?>><?php echo $category->name; ?></option>
													<?php }
												?>
											</select>
											<input type="text" name="tags_input" value="<?php echo implode( ', ', $original_project['tags_input'] ); ?>" class="project-tags" placeholder="Tags *" required />
										</div>
										<div class="funding-goals">
											<input type="number" step="any" min="500" name="project_meta[min_funding_goal]" maxlength="6" value="<?php echo $original_project_meta['min_funding_goal']; ?>" placeholder="Minimum Funding Goal *" required />
											<!-- Hidden until equity investments begin. -->
											<!-- <input type="number" name="project_meta[max_funding_goal]" maxlength="6" placeholder="Maximum Funding Goal *" required />
											<label for="minimum_investment_amount">Minimum Investment Amount *</label>
											<select name="project_meta[minimum_investment_amount]" id="minimum_investment_amount" required>
												<option>--</option>
												<option value="$1 - $5">$10</option>
												<option value="$5 - $20">$20</option>
												<option value="$20 - $100">$40</option>
												<option value="$100 - $1,000">$80</option>
											</select> -->
										</div>
										<div class="tax-status">
											<strong>Are donations to your organization, and this project, tax deductible?</strong>
											<?php if ( $original_project_meta[irs_tax_deductible] === 'true' ) {
												$true = 'checked';
											} else {
												$false = 'checked';
											} ?>
											<input type="radio" name="project_meta[irs_tax_deductible]" value="true" id="irs_tax_deductible=yes" <?php echo $true ?> /> <label for="irs_tax_deductible=yes">Yes</label>
											<input type="radio" name="project_meta[irs_tax_deductible]" value="false" id="irs_tax_deductible=no" <?php echo $false ?> /> <label for="irs_tax_deductible=no">No</label>

											<script type="text/javascript">
												$(document).ready(function() {
													$( 'div.tax-status-details :input' ).prop( "disabled", true );
													$( 'input[name="project_meta[irs_tax_deductible]"]' ).change( function() {
														if( $( 'input[name="project_meta[irs_tax_deductible]"]:checked' ).val() === "false" ) {
															$( 'div.tax-status-details :input' ).prop( "disabled", true );
														} else {
															$( 'div.tax-status-details :input' ).prop( "disabled", false );
														}
													});
												});
											</script>

											<div class="tax-status-details">
												<input type="text" name="project_meta[irs_ein]" value="<?php echo $original_project_meta[irs_ein] ?>" placeholder="EIN" />
												<input type="text" name="project_meta[irs_name]" value="<?php echo $original_project_meta[irs_name] ?>" placeholder="Name" />
												<input type="text" name="project_meta[irs_city]" value="<?php echo $original_project_meta[irs_city] ?>" placeholder="City" />
												<select name="project_meta[irs_state]" class="state">
													<option value="" disabled>State</option>
													<?php
														$states = get_states_array();
														foreach ( $states as $state ) { ?>
															<?php $selected = $original_project_meta['state'] === $state['abbr'] ? 'selected' : ''; ?>
															<option value="<?php echo $state['abbr']; ?>" <?php echo $selected; ?>><?php echo $state['full_name']; ?></option>
														<?php }
													?>
												</select>
												<input type="text" name="project_meta[irs_country]" value="<?php echo $original_project_meta[irs_country] ?>" placeholder="Country" class="country" />
											</div>
										</div>
										<div>
											<input type="submit" value="Submit" />
										</div>
									</form>

								<?php else : ?>

									<?php get_template_part( 'login' ); ?>

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
