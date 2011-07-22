<!doctype html>
<html>
<head>
	<title>Alignments</title>
	<link href="<?php echo base_url(); ?>css/jquery-ui/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/forms/screen.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/forms/dropdown.css">

	<link href="<?php echo base_url(); ?>css/validate/validationEngine.jquery.css" rel="stylesheet" type="text/css" />

	<link href="<?php echo base_url(); ?>css/stylesheet.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>css/see-modules/see.alignments.css" rel="stylesheet" type="text/css" />

	<!-- <script type="text/javascript" src="<?php echo base_url(); ?>js/forms/helpers.js"></script> -->
	<!-- <script type="text/javascript" src="<?php echo base_url(); ?>js/forms/date.js"></script> -->
	<!-- <script type="text/javascript" src="<?php echo base_url(); ?>js/forms/form.js"></script> -->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/jquery-ui.min.js"></script>

	<script type="text/javascript" src="<?php echo base_url(); ?>js/forms/jquery.form.js"></script>

	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.inputhints.min.js"></script>

	<script type="text/javascript" src="<?php echo base_url(); ?>js/validate/languages/jquery.validationEngine-en.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/validate/jquery.validationEngine.js"></script>

	<script type="text/javascript" src="<?php echo base_url(); ?>js/see.general.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/see-modules/see.alignments.js"></script>

	<script>
	$(function() {
		alignment_init();

		if ($("#flash").html() != "")
		{
			$("#flash").addClass("has_messages");
		}

		$(".list_button, .list_button2").button();

		$(".alignment_delete_check").live("click", function() {
			$(this).parent().toggleClass("marked_for_delete");

			control_buttons_check();

			if ($(".alignment_delete_check:checked").length == 0)
			{
				clear_mass_change_table();
			}
		});

		$("#btnEditAlignments").click(function() {
			$(".alignment_delete_check:checked").each(function() {
				var to_append = false;

				if ($("#alignment_mass_changes tbody tr td").children().first().val() != "")
				{
					var new_row = $("#alignment_mass_changes").children("tbody").children().first().clone();
					to_append = true;
				}
				else
				{
					var new_row = $("#alignment_mass_changes tbody").children().first();
				}

				var alignment_id = $(this).siblings("input").val();
				var alignment = $(this).siblings(".item_name").text();

				new_row.children().first().text(alignment);

				var inputs = new_row.children().last().children();
				inputs.first().val(alignment);
				inputs.last().val(alignment_id);

				if (to_append)
				{
					$("#alignment_mass_changes tbody").append(new_row);
				}
			});

			$("#massEditAlignmentsDialog").dialog("open");
		});

		$("#btnMassClear").button().click(function(e) {
			e.preventDefault();

			$("#massEditAlignmentsDialog").dialog("close");

			clear_mass_change_table();
			control_buttons_check();
		});

		$("#massEditAlignmentsDialog").dialog({
			autoOpen: false
		});		
	});

	function control_buttons_check()
	{
		var num_checked = $(".alignment_delete_check:checked").length;

		if (num_checked == 0 && $("#btnDeleteAlignments").is(":visible"))
		{
			$("#btnEditAlignments").hide();
			$("#btnDeleteAlignments").hide();
		}
		else if (num_checked > 0 && $("#btnDeleteAlignments").not(":visible"))
		{
			$("#btnEditAlignments").show();
			$("#btnDeleteAlignments").show();
		}
	}

	function clear_mass_change_table()
	{
		// First clone a row to empty and reinsert
		var save_row = $("#alignment_mass_changes").children("tbody").children().first().clone();

		// Empty contents of cloned row
		save_row.children().first().text("");
		
		var inputs = save_row.children().last().children();
		inputs.first().val("");
		inputs.last().val("");

		// Remove all tbody rows
		$("#alignment_mass_changes").children("tbody").empty();

		// Append "cleaned" row
		$("#alignment_mass_changes").children("tbody").append(save_row);

		// Uncheck checkboxes
		$(".alignment_delete_check:checked").each(function() {
			$(this).trigger("click");
		});
	}
	</script>

	<style>
	table {
		border: 1px solid black;
		border-collapse:collapse;
		width: 100%;
	}

	th, td {
		border: 1px solid black;
		padding: 5px;
		text-align: center;
		width: 50%;
	}

	td input {
		width: 90%;		
	}
	</style>
</head>
<body>
	<div id="flash">
		<?php echo $this->session->flashdata('form_message'); ?>
	</div>

	<div>
		<div class="list_header">
			<h1>Alignments</h1>
			<div class="list_controls">
				<button id="btnAddAlignment" class="list_button2">Add Alignment</button>
				<button id="btnEditAlignments" class="list_button2 hide">Edit Checked</button>
				<button id="btnDeleteAlignments" class="list_button2 hide">Delete Checked</button>			
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
		<ul id="alignments">
			<?php if ($num_alignments != 0): ?>
				<?php foreach ($alignments as $alignment): ?>
			<li>
				<input type="checkbox" name="delete_alignment[]" class="alignment_delete_check" value="1" />
				<span class="item_name"><?php echo $alignment->description; ?></span>
				<input type="hidden" value="<?php echo $alignment->id; ?>" />
				<button class="list_button delete_item">Delete</button>
				<button class="list_button edit_item">Edit</button>
				<div class="clear"></div>
			</li>
				<?php endforeach; ?>
			<?php endif; ?>
		</ul>
	</div>

	<div id="addAlignmentDialog" title="Add Alignment">
		<?php
		$attr = array("id" => "frmAddAlignment");
		//echo form_open("alignments/add_alignment", $attr);
		echo form_open("alignments/add_alignment_ajax", $attr);

		echo form_fieldset("Add Alignment");

		echo form_label('Alignment: ', 'alignment_description');
		$data = array(
			'name'	=>	'alignment_description',
			'id'	=>	'alignment_description',
			'class'	=>	'form_input validate[required]',
			'value'	=>	'',
			'title'	=>	'ie Face, Heel, etc'
		);
		echo form_input($data);
		echo form_fieldset_close();
		?>
		<br />
		<?php
		unset($attr);
		$attr = array(
			"id"	=> "btnSubmit",
			"name"	=> "btnSubmit"
		);
		echo form_submit($attr, 'Add Name');
		echo form_close();
		?>
	</div>

	<div id="editAlignmentDialog" title="Edit Alignment">
		<?php
		$attr = array("id" => "frmUpdateAlignment");
		echo form_open("alignments/update_alignment_ajax", $attr);		
		echo form_label('Alignment: ', 'edit_description');
		$data = array(
			'name'	=> "edit_description",
			'id'	=> "edit_description",
			'class'	=>	'form_input validate[required]',
			'value'	=>	''
		);
		echo form_input($data);
		?>
		<br />
		<input type="hidden" name="alignment_id" id="alignment_id" value="" />
		<br />
		<?php echo form_close(); ?>	
	</div>

	<div id="confirmDeleteAlignmentDialog" title="Delete this alignment?">
		<p>
			<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
			"<span></span>" will be permanently deleted. Are you sure?
		</p>

		<?php
		unset($attr);
		$attr = array("id" => "frmDeleteAlignment");
		echo form_open("alignments/delete_alignment_ajax", $attr);
		?>
		<input type="hidden" name="alignment_delete_id" id="alignment_delete_id" value="" />
		<?php
		echo form_close();
		?>
	</div>

	<div id="massEditAlignmentsDialog" title="Mass Edit Alignments">
		<?php
		$attr = array("id" => "frmMassUpdateAlignment");
		echo form_open("alignments/update_alignment_ajax", $attr);
		?>

		<table id="alignment_mass_changes">
			<thead>
				<tr>
					<th>Original</th>
					<th>New</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td></td>
					<td class="change_data">
						<input type="text" value="" />
						<input type="hidden" value="" />
					</td>
				</tr>
			</tbody>
		</table>

		<br /><br />

		<button id="btnMassClear">Clear</button>
		<?php
		echo form_close();
		?>
	</div>
</body>
</html>