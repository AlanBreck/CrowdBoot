<?php
/*
Template Name: Project Creation Template
*/
?>
<?php

	if ( ! is_user_logged_in() ) {
		header( "location: " . site_url( 'log-in' ) . '/?redirect_to=' . get_permalink() . '&intent=create_project' );
	}

	if ( $_POST ) {
		$post_category = get_cat_ID( $_POST['post_category'] );
		$project_post = array(
			'comment_status' => 'closed',
			'ping_status'    => 'closed',
			'post_author'    => $current_user->ID,
			'post_content'   => $_POST['post_content'],
			'post_excerpt'   => $_POST['post_excerpt'],
			'post_name'      => $_POST['post_title'] . '-' . rand( 100, 999 ),
			'post_title'     => wp_strip_all_tags( $_POST['post_title'] ),
			'post_type'      => 'project',
			'post_status'	 => 'pending',
			'tags_input'	 => $_POST['tags_input']
		);

		$user_updates = array(
			'first_name'    => $_POST['first_name'],
			'last_name'     => $_POST['last_name'],
			'user_url'      => $_POST['user_url'],
			'user_nicename' => $_POST['first_name'] . $_POST['last_name'],
		);

		$new_post = wp_insert_post( $project_post, $current_user->ID );

		wp_update_user( $user_updates );

		wp_set_post_terms( $new_post, array( $post_category ), 'category' );

		add_post_meta( $new_post, '_cmb_min_funding_goal', preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $_POST['min_funding_goal'] ) );
		add_post_meta( $new_post, '_cmb_max_funding_goal', preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $_POST['max_funding_goal'] ) );
		add_post_meta( $new_post, '_cmb_minimum_investment_amount', $_POST['minimum_investment_amount'] );
		add_post_meta( $new_post, '_cmb_irs_tax_deductible', $_POST['irs_tax_deductible'] );
		add_post_meta( $new_post, '_cmb_irs_ein', $_POST['irs_ein'] );
		add_post_meta( $new_post, '_cmb_irs_name', $_POST['irs_name'] );
		add_post_meta( $new_post, '_cmb_irs_city', $_POST['irs_city'] );
		add_post_meta( $new_post, '_cmb_irs_state', $_POST['irs_state'] );
		add_post_meta( $new_post, '_cmb_irs_country', $_POST['irs_country'] );

		header( "location: " . ( TRUE == $new_post ? get_permalink( $new_post ) : 'you-are-dumb' ) );
	}
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

								<?php if ( is_user_logged_in() && current_user_can( 'publish_projects' ) ) : ?>

									<form method="post">
										<div class="user-name">
											<input type="text" name="first_name" placeholder="First Name *" required />
											<input type="text" name="last_name" placeholder="Last Name *" required />
										</div>
										<div class="project-name">
											<input type="text" name="post_title" placeholder="Project Name *" required />
										</div>
										<div>
											<textarea type="text" name="post_excerpt" placeholder="Short Description *" rows="4" required></textarea>
										</div>
										<div>
											<textarea type="text" name="post_content" placeholder="Full Description" rows="7"></textarea>
										</div>
										<div>
											<select name="post_category" id="post_category" class="project-category" required>
												<option>Project Category *</option>
												<option value="Culinary Arts">Culinary Arts</option>
												<option value="Education">Education</option>
												<option value="Finance">Finance</option>
												<option value="Hospitality">Hospitality</option>
												<option value="Media">Media</option>
												<option value="Real Estate">Real Estate</option>
												<option value="Software">Software</option>
												<option value="Product">Product</option>
												<option value="Tech">Tech</option>
												<option value="Hygiene">Hygiene</option>
												<option value="Furniture">Furniture</option>
												<option value="Decor">Decor</option>
												<option value="Service">Service</option>
												<option value="Manual Labor">Manual Labor</option>
												<option value="Software">Software</option>
												<option value="Charitable">Charitable</option>
												<option value="Boy Scout Projects">Boy Scout Projects</option>
												<option value="Science Fair Projects">Science Fair Projects</option>
											</select>
											<input type="text" name="tags_input" placeholder="Tags *" class="project-tags" required />
										</div>
										<div class="funding-goals">
											<input type="number" min="500" name="min_funding_goal" maxlength="6" placeholder="Minimum Funding Goal *" required />
											<!-- Hidden until equity investments begin. -->
											<!-- <input type="number" name="max_funding_goal" maxlength="6" placeholder="Maximum Funding Goal *" required />
											<label for="minimum_investment_amount">Minimum Investment Amount *</label>
											<select name="minimum_investment_amount" id="minimum_investment_amount" required>
												<option>--</option>
												<option value="$1 - $5">$10</option>
												<option value="$5 - $20">$20</option>
												<option value="$20 - $100">$40</option>
												<option value="$100 - $1,000">$80</option>
											</select> -->
										</div>
										<div class="tax-status">
											<strong>Are donations to your organization, and this project, tax deductible?</strong>
											<input type="radio" name="irs_tax_deductible" value="true" id="irs_tax_deductible=yes" /> <label for="irs_tax_deductible=yes">Yes</label>
											<input type="radio" name="irs_tax_deductible" value="false" id="irs_tax_deductible=no" /> <label for="irs_tax_deductible=no">No</label>
											<div class="tax-status-details">
												<input type="text" name="irs_ein" placeholder="EIN" />
												<input type="text" name="irs_name" placeholder="Name" />
												<input type="text" name="irs_city" placeholder="City" />
												<select name="state" class="state">
													<option value="" selected="selected">State</option>
													<option value="AL">Alabama</option>
													<option value="AK">Alaska</option>
													<option value="AZ">Arizona</option>
													<option value="AR">Arkansas</option>
													<option value="CA">California</option>
													<option value="CO">Colorado</option>
													<option value="CT">Connecticut</option>
													<option value="DE">Delaware</option>
													<option value="DC">District Of Columbia</option>
													<option value="FL">Florida</option>
													<option value="GA">Georgia</option>
													<option value="HI">Hawaii</option>
													<option value="ID">Idaho</option>
													<option value="IL">Illinois</option>
													<option value="IN">Indiana</option>
													<option value="IA">Iowa</option>
													<option value="KS">Kansas</option>
													<option value="KY">Kentucky</option>
													<option value="LA">Louisiana</option>
													<option value="ME">Maine</option>
													<option value="MD">Maryland</option>
													<option value="MA">Massachusetts</option>
													<option value="MI">Michigan</option>
													<option value="MN">Minnesota</option>
													<option value="MS">Mississippi</option>
													<option value="MO">Missouri</option>
													<option value="MT">Montana</option>
													<option value="NE">Nebraska</option>
													<option value="NV">Nevada</option>
													<option value="NH">New Hampshire</option>
													<option value="NJ">New Jersey</option>
													<option value="NM">New Mexico</option>
													<option value="NY">New York</option>
													<option value="NC">North Carolina</option>
													<option value="ND">North Dakota</option>
													<option value="OH">Ohio</option>
													<option value="OK">Oklahoma</option>
													<option value="OR">Oregon</option>
													<option value="PA">Pennsylvania</option>
													<option value="RI">Rhode Island</option>
													<option value="SC">South Carolina</option>
													<option value="SD">South Dakota</option>
													<option value="TN">Tennessee</option>
													<option value="TX">Texas</option>
													<option value="UT">Utah</option>
													<option value="VT">Vermont</option>
													<option value="VA">Virginia</option>
													<option value="WA">Washington</option>
													<option value="WV">West Virginia</option>
													<option value="WI">Wisconsin</option>
													<option value="WY">Wyoming</option>
												</select>
												<input type="text" name="irs_country" placeholder="Country" class="country" />
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
