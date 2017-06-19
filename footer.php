

<footer class="site-footer <?php if (is_page_template('templates/template-map.php')){ echo 'hide';}?>">
	<div class="content-bar">
		<div class="container">
			<div class="row">
				<div class="columns-2">
					<img src="<?php bloginfo('template_directory'); ?>/img/footer-logo.png" alt="America's Essential Hospitals logo" >
				</div>
				<div class='columns-6'>
					<div class="contact-info">
						<p>
							<span class="name">America's Essential Hospitals</span><br/>
							<span class="address">401 Ninth St NW, Ste 900, Washington, DC 20004</span></br>
							<span class="contact">202.585.0100  |  <a href="mailto:info@essentialhospitals.org">info@essentialhospitals.org</a></span>
						</p>
					</div>
				</div>
				<div class="columns-4">
					<div class="share">
						<div class="share-statement">
							Share the work<br/>
							of essential communities<br/>
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
			<!-- <p class="signature">Site design by <a href="http://meshfresh.com">MESH</a></p> -->
		</div>
	</div>
</footer>

<?php wp_footer(); ?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-101294034-1', 'auto');
  ga('send', 'pageview');

</script>

<script>var $dir = '<?php echo get_template_directory_uri(); ?>';  </script>

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<?php if (!is_page_template("templates/template-map.php")) {?>
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-593039cafc329c1e"></script>
<?php } ?>

</body>
</html>


