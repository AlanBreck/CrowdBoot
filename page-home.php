<?php
/*
Template Name: Home Page
*/
?>
<?php get_header(); ?>

			<div class="home-menu-container">
				<ul class="home-menu clearfix wrap">
					<li><a href="<?php echo site_url(); ?>/projects">Browse Projects</a></li>
					<li><a href="<?php echo site_url(); ?>/create-a-project/">Create a Project</a></li>
				</ul>
			</div>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

				    <div id="main" class="clearfix" role="main">

						<article class="first fourcol box1">
							<h2>What is Crowdfunding?</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum, omnis, voluptates, ab totam sit deleniti molestias soluta maxime facilis sunt minus esse inventore quaerat in minima nostrum vel error officia.</p>
						</article>

						<article class="fourcol box2">
							<h2>Who is CrowdBoot?</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum, omnis, voluptates, ab totam sit deleniti molestias soluta maxime facilis sunt minus esse inventore quaerat in minima nostrum vel error officia.</p>
						</article>

						<article class="last fourcol box3">
							<h2>What customers do CrowdBoot serve?</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum, omnis, voluptates, ab totam sit deleniti molestias soluta maxime facilis sunt minus esse inventore quaerat in minima nostrum vel error officia.</p>
						</article>

				    </div> <!-- end #main -->

				</div> <!-- end #inner-content -->

			</div> <!-- end #content -->

<?php get_footer(); ?>