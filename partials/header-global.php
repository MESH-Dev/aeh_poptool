<header class="navigation-bar <?php if(!is_page_template('templates/template-map.php')){echo 'global'; }?>" >
		<div class="container">

			<div class="row"><!-- //columns-12 -->
				<div class="navigation-logo columns-2">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<img src="<?php bloginfo('template_directory'); ?>/img/logo-full.png" >
						<span class="sr-only">Click here to return to homepage</span>
					</a>
     			</div>
				<nav class="main-navigation">
					<?php if(has_nav_menu('main_nav')){
								$defaults = array(
									'theme_location'  => 'main_nav',
									'menu'            => 'main_nav',
									'container'       => false,
									'container_class' => '',
									'container_id'    => '',
									'menu_class'      => 'menu',
									'menu_id'         => '',
									'echo'            => true,
									'fallback_cb'     => 'wp_page_menu',
									'before'          => '',
									'after'           => '',
									'link_before'     => '',
									'link_after'      => '',
									'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
									'depth'           => 0,
									'walker'          => ''
								); wp_nav_menu( $defaults );
							}else{
								echo "<p><em>main_nav</em> doesn't exist! Create it and it'll render here.</p>";
							} ?>
				</nav>
			</div>
			<a id="menuButton" class="menu-button">
				MENU
			</a>
		</div>
	</header>
