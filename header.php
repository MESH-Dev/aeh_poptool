<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->

<head>

	<meta charset="utf-8">
	<title><?php bloginfo('name'); ?></title>

	<!-- Meta / og: tags -->
	<meta name="description" content="">
	<meta name="author" content="">

	<meta name="msvalidate.01" content="2769E9F62BF3F327ED3BF080893E4271" />

	<!-- Mobile Specific Metas
	================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
	================================================== -->
	<link href='https://fonts.googleapis.com/css?family=Cabin:400,600,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />


	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="<?php bloginfo('url' );?>/favicon.ico">
	<link rel="apple-touch-icon" href="<?php bloginfo('url' );?>/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('url' );?>/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('url' );?>/apple-touch-icon-114x114.png">

	<!-- Fonts
	================================================== -->
	<link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">

	<!-- Bugherd
	================================================== -->
	<!--<script type='text/javascript'>
	(function (d, t) {
	  var bh = d.createElement(t), s = d.getElementsByTagName(t)[0];
	  bh.type = 'text/javascript';
	  bh.src = 'https://www.bugherd.com/sidebarv2.js?apikey=yqsy4bao6vlyvoxgc15tbq';
	  s.parentNode.insertBefore(bh, s);
	  })(document, 'script');
	</script>-->

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

 
		<?php get_template_part('partials/header-global'); ?>
 