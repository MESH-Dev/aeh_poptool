<?php get_header(); ?>

<main id="content" class="interior">

	<div class="container">
		<div class="row">
			<div class="page-content columns-8">
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
					<div class="wrap">
						<h1 class="page-title"><?php the_title(); ?></h1>
						<h2 class="headline">
							<?php echo get_field('headline'); ?>
						</h2>
						<div class="the-content">
							<?php the_content(); ?>
						</div>
					</div>
				<?php endwhile; ?>
			</div>

			<div class="columns-4">
				<div class="cta-sidebar">

				<!-- Change this to repeater of custom fields -->
				<?php if (have_rows('sidebar_cta')):
						while(have_rows('sidebar_cta')):the_row();
						$text = get_sub_field('cta_text');
						$link = get_sub_field('cta_link');
						$external = get_sub_field('external');
						?>

					<div class="side-cta">
						<div class="wrap">
							<a href="<?php echo $link; ?>" <?php if($external){echo 'target="_blank"';}?>>
							<h2>
								
								<?php echo $text; ?>
								
							</h2>
							<h3>Learn more &raquo; </h3>
							</a>
						</div>
					</div>
				<?php endwhile; endif; ?>
				<?php //get_sidebar(); ?>
				</div>
			</div>

		</div>
	</div>

</main><!-- End of Content -->

<?php get_footer(); ?>
