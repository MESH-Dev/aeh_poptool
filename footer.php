 

<footer class="site-footer">

	<div class="container">
		<div class="row">
			<div class="columns-12">
				<nav class="main-navigation">
					<?php wp_nav_menu( array('menu_id' => 'footer-menu', 'theme_location' => 'footer-menu') ); ?>
				</nav>
					<p>Designed by <a href="http://meshfresh.com" target="_blank">MESH</a></p>
			</div><!-- End of Footer -->
		</div>
	</div>

</footer>
<!-- <script src="js/map.js"></script> -->
<script src="<?php echo get_template_directory_uri() ?>/js/map.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXR8bORut0sXyoust5FWnhi-9TA8TWktw&callback=initMap"></script>

</body>
</html>

<?php wp_footer(); ?>

</body>
</html>
