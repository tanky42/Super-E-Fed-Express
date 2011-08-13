<!doctype html>
<html>
<head>
	<title>FED NAME GOES HERE!</title>

	<!-- Grid Stylesheets -->
	<link href="<?php echo base_url(); ?>css/grid/reset.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>css/grid/text.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>css/grid/grid.css" rel="stylesheet" />

	<!-- Get fonts from Google -->
	<link href='http://fonts.googleapis.com/css?family=Michroma' rel='stylesheet' type='text'>
	<!--[if lt IE 9]><link href="<?php echo base_url(); ?>css/ie.css" rel='stylesheet' type='text/css'><![endif]-->

	<link href="<?php echo base_url(); ?>css/jquery-ui/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>css/sheep/buttons.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>css/sheep/forms.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>css/validate/jquery.validval.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>css/gritter/jquery.gritter.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>css/pagination/pagination.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>css/stylesheet.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>css/menu/menu.css" rel="stylesheet" type="text/css" />

	<!-- Script to enable HTML5 compatibility in IE -->
	<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

	<!-- Load jQuery & jQuery UI -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/jquery-ui.min.js"></script>

	<!-- jQuery Plugins -->
	<script type="text/javascript" src="<?php echo base_url(); ?>js/sheep/jquery.sheepItPlugin-1.0.0.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/validate/jquery.validVal-2.4.2.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/validate/jquery.validVal-customValidations.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/gritter/jquery.gritter.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/pagination/jquery.pagination.js"></script>

	<!-- Custom Scripts -->
	<script type="text/javascript" src="<?php echo base_url(); ?>js/menu/menu.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/see.general.js"></script>

	<script>
	var base_url = "<?php echo base_url(); ?>";

	$(function() {
		init();
	});
	</script>
</head>
<body>
	<div class="container clearfix">
		<div id="header" class="grid_24">
			<p>This is the header</p>
		</div>
		
		<div id="main" class="grid_24">
			<div id="main_nav" class="grid_3 alpha">
				<?php echo $menu; ?>
			</div>
			
			<div id="content" class="grid_21">