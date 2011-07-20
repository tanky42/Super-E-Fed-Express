<!doctype html>
<html>
<head>
	<title>Test</title>
	<style>
	body {
		font-family: sans-serif;
		font-size: 14px;
		margin: 40px;
	}

	.content {
		float: left;
		width: 45%;
	}

	.clear {
		clear: both;
	}
	</style>
</head>
<body>
	<p><?php echo $message; ?></p>

	<div class="content">
		<?php		
		echo form_open('tests/index');
		echo form_label('First name: ', 'first_name');
		$data = array(
			'name'	=>	'first_name',
			'id'	=>	'first_name',
			'value'	=>	''
		);
		echo form_input($data);
		?>
		<br />
		<?php
		echo form_label('Last name: ', 'last_name');
		$data = array(
			'name'	=>	'last_name',
			'id'	=>	'last_name',
			'value'	=>	''
		);
		echo form_input($data);
		?>
		<br />
		<?php
		echo form_submit('btnSubmit', 'Add Name');
		echo form_close();
		?>
	</div>

	<div class="content">
		<h3>Names</h3>
		<ul>
			<?php foreach($names as $name): ?>
			<li><?php echo $name->name; ?> <?php echo $name->lname->lName; ?></li>
			<?php endforeach; ?>
		</ul>
	</div>

	<div class="clear"></div>
</body>
</html>