

<footer class="site-footer <?php if (is_page_template('templates/template-map.php')){ echo 'hide';}?>">
	<div class="content-bar">
		<div class="container">
			<div class="row">
				<div class="columns-2">
					<img src="<?php bloginfo('template_directory'); ?>/img/footer-logo.png" >
				</div>
				<div class='columns-6'>
					<div class="contact-info">
						<p>
							<span class="name">America's Essential Hospitals<span><br/>
							<span class="address">1301 Pennsylvania Ave. NW, Suite 950, Washington, DC 20004<span></br>
							<span class="contact">202.585.0100  |  <a href="mailto:info@essentialhospitals.org">info@essentialhospitals.org</a></span>
						</p>
					</div>
				</div>
				<div class="columns-4">
					<div class="share">
						<div class="share-statement">
							Share the work<br/>
							of healthy communities<br/>
							with people Online:
						</div>
						<div class="add-this addthis_inline_share_toolbox"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="sig-bar">
		<div class="container">
			<p class="signature">Site design by <a href="http://meshfresh.com">MESH</a></p>
		</div>
	</div>
</footer>
<script>var $dir = '<?php echo get_template_directory_uri(); ?>';  </script>
<!-- <script src="js/map.js"></script> -->

<!-- <?php //if (is_page_template('/templates/template-map.php')) {?>
	<script src="<?php echo get_template_directory_uri() ?>/js/map.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXR8bORut0sXyoust5FWnhi-9TA8TWktw&amp;callback=initMap"></script>
<?php// } ?> -->

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<?php if (!is_page_template("templates/template-map.php")) {?>
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-593039cafc329c1e"></script>
<?php } ?>

</body>
</html>

<?php wp_footer(); ?>
