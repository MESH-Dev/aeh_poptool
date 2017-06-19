<?php get_header(); ?>

<main id="content" class="page-404">
	<div class="container">
		<div class="row">
			<div class="columns-9">
				<div class="content">
					<h1>Page Not Found</h1>
					<h2>The page you requested could not be found.</br>
						Perhaps go back to the <a href="<?php echo esc_url( home_url( '/' ) ); ?>">homepage</a> and try again?</h2>
				</div>
				<?php //get_search_form(); ?>
			</div>
		</div>
	</div>
</main><!-- End of Content -->


<?php //get_sidebar(); ?>
<?php get_footer(); ?>