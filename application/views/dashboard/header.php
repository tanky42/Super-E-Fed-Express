<!doctype html>
<html>
<head>
	<title><?php echo $page_title; ?></title>
	<link href="<?php echo base_url(); ?>css/jquery-ui/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>css/stylesheet.css" rel="stylesheet" type="text/css" />

	<!-- Script to enable HTML5 compatibility in IE -->
	<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/see.general.js"></script>
</head>
<body>
	<header>
		<h1>Super E-Fed Express</h1>

		<div id="flash">
			<?php echo $this->session->flashdata('form_message'); ?>
		</div>

		<nav>
			<ul>
				<li><a href="<?php echo base_url(); ?>index.php/alignments">Alignments</a></li>
			</ul>
		</nav>
	</header>

	<section id="main">