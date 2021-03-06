<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="utf-8">

		<title><?php wp_title(''); ?></title>

		<!-- Google Chrome Frame for IE -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<!-- mobile meta (hooray!) -->
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

		<!-- icons & favicons (for more: http://themble.com/support/adding-icons-favicons/) -->
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">

  		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<!-- wordpress head functions -->
		<?php wp_head(); ?>
		<!-- end of wordpress head -->

		<!-- drop Google Analytics Here -->
		<!-- end analytics -->

	</head>

	<body <?php body_class(); ?>>

		<div id="container">

			<header class="header" role="banner">

				<div id="inner-header" class="wrap clearfix">

					<?php if ( is_page( 'Home' ) ) : ?>

						<a id="logo" href="<?php echo home_url(); ?>" rel="nofollow"><img src="<?php echo get_stylesheet_directory_uri(); ?>/library/images/logo.png"></a>
						<?php // bloginfo('description'); ?>

					<?php else : ?>

						<!-- to use a image just replace the bloginfo('name') with your img src and remove the surrounding <p> -->
						<a id="logo" href="<?php echo home_url(); ?>" rel="nofollow"><img src="<?php echo get_stylesheet_directory_uri(); ?>/library/images/logo.png" width="260"></a>

						<nav role="navigation" class="clearfix">
							<?php
								if(!getMainMenu('main-nav')){
									$backup = $wp_query;
									$wp_query = NULL;
									$wp_query = new WP_Query(array('post_type' => 'post'));
									getMainMenu('main-nav');
									$wp_query = $backup;
								}
							?>
							<ul class="user-quicklinks">
								<li class="user-profile">
									<?php if ( is_user_logged_in() ): global $current_user; ?>
										<a href="<?php echo site_url( 'my-dashboard' ); ?>" class="fn image-link"><?php echo get_avatar( $current_user->ID, 60 ); ?></a>
									<?php else : ?>
										<a href="#" class="fn url pictogram">&#128100;</a>
									<?php endif; ?>
									<ul class="sub-menu">
										<?php
											$loginout  = is_user_logged_in() ? wp_logout_url( get_permalink() ) : site_url( '/log-in/?redirect_to=' ) . get_permalink();
											$logintext = is_user_logged_in() ? 'Log Out' : 'Log In';
										?>
										<?php if ( is_user_logged_in() ) : ?>
										<li><a href="<?php echo site_url( 'my-dashboard' ); ?>">Dashboard</a></li>
										<?php endif; ?>
										<li><a href="<?php echo $loginout; ?>"><?php echo $logintext; ?></a></li>
									</ul>
								</li>
							</ul>
							<?php if( is_user_logged_in() ): ?>
								<?php global $current_user; ?>
								<?php if ( $current_user->user_firstname != '' ) : ?>
									<span class="hello">Hey, <?php echo $current_user->user_firstname; ?>!</span>
								<?php endif; ?>
							<?php endif; ?>
						</nav>

					<?php endif; ?>

				</div> <!-- end #inner-header -->

			</header> <!-- end header -->
