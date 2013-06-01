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
							<p>Crowdfunding is the act of raising funds from the CROWD (You). Clear as mud, right? The CROWD is the term that has been given to a large group of donors or investors all contributing toward a common goal.</p>
						</article>

						<article class="fourcol box2">
							<h2>Who is CrowdBoot?</h2>
							<p>CROWDBOOT is a Crowd Funding Platform as defined in the Jumpstart Our Business Startups (JOBS) Act signed into law on April 5, 2012.
							<br/>
							Our mission is to simplify and speed up the fund raising process for small companies, non-profits, startups, and social entrepreneurs so that they and the CROWD supporting them can impact the economy, faster than ever before.</p>
						</article>

						<article class="last fourcol box3">
							<h2>What customers do CrowdBoot serve?</h2>
							<p><strong>Investors / Supporters</strong>
							<br/>
							Are you an investor looking for a return or a supporter looking to further a cause? Either way CrowdBoot.com will connect you to today’s innovators.
							<br/>
							<strong>Small Businesses / Startups / Social Entrepreneurs</strong>
							<br/>
							Create your own custom project and give your ideas wings by becomimg one of the growing CrowdBoot community.  CrowdBoot is a fantastic way to raise money and spread the word.</p>
						</article>

				    </div> <!-- end #main -->

				</div> <!-- end #inner-content -->

			</div> <!-- end #content -->

<?php get_footer(); ?>