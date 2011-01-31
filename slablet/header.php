<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<title><?php wp_title(); ?> <?php bloginfo( 'name' ); ?></title>
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
<link rel="stylesheet" href="<?php bloginfo('template_url');?>/assets/stylesheets/master.css" />
<!--[if IE 8]>
<link rel="stylesheet" href="<?php bloginfo('template_url');?>/assets/stylesheets/ie8.css" />
<![endif]-->
<!--[if !IE]><!-->
<script src="<?php bloginfo('template_url');?>/assets/javascripts/iscroll.js"></script>
<!--<![endif]-->
<script src="<?php bloginfo('template_url');?>/assets/javascripts/jquery.js"></script>
<script src="<?php bloginfo('template_url');?>/assets/javascripts/master.js"></script>
<?php wp_head(); ?>
</head>
<body>
<div id="main" class="abs">
	<div class="abs header_upper chrome_light">
		<span class="float_left button" id="button_navigation">
			Navigation
		</span>
		<a href="javascript: history.go(-1)" class="float_left button">
			Back
		</a>
		<?php bloginfo('name');?>
	</div>