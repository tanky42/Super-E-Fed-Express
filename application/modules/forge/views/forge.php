<!doctype html>
<html>
<head>
	<title>Database Forge</title>

	<link href="<?php echo base_url(); ?>css/jquery-ui/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/jquery-ui.min.js"></script>

	<style>
	body {
		font-family: sans-serif;
		font-size: 14px;
		margin: 20px;
	}

	.needed_tables {
		margin-bottom: 15px;
	}

	#existing_tables {
		border: 1px solid #ccc;
		margin-right: 25px;
		width: 35%;
	}

	.tableDiv {
		border: 1px solid #eee;
		margin: auto;
		position: relative;
	}

	.table_name {
		font-weight: bold;
	}

	.tableInfo {
		border: 1px solid black;
		border-collapse: collapse;
		margin: auto;
		position: relative;
	}

	.tableInfo tr, .tableInfo th, .tableInfo td {
		border: 1px solid black;
	}

	.tableInfo th, .tableInfo td {
		padding: 5px;
	}

	.primary_key {
		background: #99FFCC;
		text-align: center;
	}

	.clear {
		clear: both;
	}

	.column {
		float: left;
		padding-bottom: 100px;
		width: 25%;
	}

	.portlet {
		margin: 0 1em 1em 0;
	}

	.portlet-header {
		margin: 0.3em;
		padding-bottom: 4px;
		padding-left: 0.2em;
	}

	.portlet-header .ui-icon {
		float: right;
	}

	.portlet-content {
		padding: 0.4em;
	}

	.ui-sortable-placeholder {
		border: 1px dotted black;
		height: 50px !important;
		visibility: visible !important;
	}

	.ui-sortable-placeholder * {
		visibility: hidden;
	}
	</style>

	<script>
	$(function() {
		$( ".column" ).sortable({
			connectWith: ".column"
		});

		$( ".portlet" ).addClass( "ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" )
			.find( ".portlet-header" )
				.addClass( "ui-widget-header ui-corner-all" )
				.prepend( "<span class='ui-icon ui-icon-minusthick'></span>")
				.end()
			.find( ".portlet-content" );

		$( ".portlet-header .ui-icon" ).click(function() {
			$( this ).toggleClass( "ui-icon-minusthick" ).toggleClass( "ui-icon-plusthick" );
			$( this ).parents( ".portlet:first" ).find( ".portlet-content" ).toggle();
		});

		$( ".portlet-header .ui-icon" ).trigger("click");

		$( ".column" ).disableSelection();
	});
	</script>
</head>
<body>
	<div id="to_add">
		<?php if (count($tables['needed'])): ?>
			<?php echo form_open("forge/add_tables"); ?>
				<table id="needed_tables">
					<thead>
						<tr>
							<th></th>
							<th>Table Name</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($tables['needed'] as $table): ?>
						<tr>
							<td>
								<input type="checkbox" name="table_name[]" value="<?php echo $table; ?>" />
							</td>
							<td>
								<?php echo ucwords($table); ?>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<?php echo form_submit("new_tables_submit", "Create Tables"); ?>
			<?php echo form_close(); ?>
		<?php endif; ?>
	</div>

	<div id="portlets">
		<div class="column">
			<?php foreach ($tables['existing'][0] as $table): ?>
			<div class="portlet">
				<div class="portlet-header"><?php echo ucwords($table['name']); ?></div>
				<div class="portlet-content">
					<table class="tableInfo">
						<thead>
							<tr>
								<th>Name</th>
								<th>Type</th>
								<th>Primary Key</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($table['fields'] as $field): ?>
							<tr>
								<td><?php echo $field['name']; ?></td>
								<td><?php echo $field['type']; ?></td>						
								<?php if ($field['key'] == 1): ?>
								<td class="primary_key">
									<strong>TRUE</strong>
								</td>
								<?php else: ?>
								<td></td>
								<?php endif; ?>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
			<?php endforeach; ?>
		</div>

		<div class="column">
			<?php foreach ($tables['existing'][1] as $table): ?>
			<div class="portlet">
				<div class="portlet-header"><?php echo ucwords($table['name']); ?></div>
				<div class="portlet-content">
					<table class="tableInfo">
						<thead>
							<tr>
								<th>Name</th>
								<th>Type</th>
								<th>Primary Key</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($table['fields'] as $field): ?>
							<tr>
								<td><?php echo $field['name']; ?></td>
								<td><?php echo $field['type']; ?></td>						
								<?php if ($field['key'] == 1): ?>
								<td class="primary_key">
									<strong>TRUE</strong>
								</td>
								<?php else: ?>
								<td></td>
								<?php endif; ?>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
			<?php endforeach; ?>
		</div>

		<div class="column">
			<?php foreach ($tables['existing'][2] as $table): ?>
			<div class="portlet">
				<div class="portlet-header"><?php echo ucwords($table['name']); ?></div>
				<div class="portlet-content">
					<table class="tableInfo">
						<thead>
							<tr>
								<th>Name</th>
								<th>Type</th>
								<th>Primary Key</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($table['fields'] as $field): ?>
							<tr>
								<td><?php echo $field['name']; ?></td>
								<td><?php echo $field['type']; ?></td>						
								<?php if ($field['key'] == 1): ?>
								<td class="primary_key">
									<strong>TRUE</strong>
								</td>
								<?php else: ?>
								<td></td>
								<?php endif; ?>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>

	<div class="clear"></div>
</body>
</html>