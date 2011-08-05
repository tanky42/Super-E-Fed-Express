<!doctype html>
<html>
<head>
	<title><?php echo $page_title; ?></title>
	<link href="<?php echo base_url(); ?>css/jquery-ui/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>css/sheep/buttons.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>css/sheep/forms.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>css/validate/jquery.validval.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>css/gritter/jquery.gritter.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>css/pagination/pagination.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>css/stylesheet.css" rel="stylesheet" type="text/css" />

	<!-- Script to enable HTML5 compatibility in IE -->
	<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/jquery-ui.min.js"></script>

	<!-- jQuery Plugins -->
	<script type="text/javascript" src="<?php echo base_url(); ?>js/sheep/jquery.sheepItPlugin-1.0.0.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/validate/jquery.validVal-2.4.2.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/validate/jquery.validVal-customValidations.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/gritter/jquery.gritter.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/pagination/jquery.pagination.js"></script>

	<!-- Custom Scripts -->
	<script type="text/javascript" src="<?php echo base_url(); ?>js/see.general.js"></script>

	<script>
	var base_url = "<?php echo base_url(); ?>";
	</script>
</head>
<body>
	<div id="header">
		<h1>Super E-Fed Express</h1>

		<div id="flash" class="message_default">
			<?php echo $this->session->flashdata('form_message'); ?>
		</div>

		<nav>
			<ul>
				<li><a href="<?php echo base_url(); ?>index.php/alignments">Alignments</a></li>
				<li><button id="btnInfoTable">Show Tables</button></li>
				<li><button id="btnShowMain" class="hide">Show Main</button></li>
			</ul>
		</nav>
	</div>

	<div id="main">