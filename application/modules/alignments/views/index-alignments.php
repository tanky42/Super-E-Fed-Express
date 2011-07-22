		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/forms/screen.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/forms/dropdown.css">

		<link href="<?php echo base_url(); ?>css/validate/validationEngine.jquery.css" rel="stylesheet" type="text/css" />

		<link href="<?php echo base_url(); ?>css/see-modules/see.alignments.css" rel="stylesheet" type="text/css" />

		<!-- <script type="text/javascript" src="<?php echo base_url(); ?>js/forms/helpers.js"></script> -->
		<!-- <script type="text/javascript" src="<?php echo base_url(); ?>js/forms/date.js"></script> -->
		<!-- <script type="text/javascript" src="<?php echo base_url(); ?>js/forms/form.js"></script> -->

		<script type="text/javascript" src="<?php echo base_url(); ?>js/forms/jquery.form.js"></script>

		<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.inputhints.min.js"></script>

		<script type="text/javascript" src="<?php echo base_url(); ?>js/validate/languages/jquery.validationEngine-en.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/validate/jquery.validationEngine.js"></script>

		<script type="text/javascript" src="<?php echo base_url(); ?>js/see-modules/see.alignments.js"></script>

		<script>
		$(function() {
			init();
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

			$("#btnMassEdit").button().click(function(e) {
				e.preventDefault();

				var ajax_url = $(this).parent().attr("action");

				$.post(ajax_url, formData,
					function(data) {
						alert("Mass Data:\n" + data);
					}
				);
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

		.settings_list {
			overflow: auto;
		}
		</style>

		<div id="alignments_list" class="settings_list">
			<?php echo Modules::run('alignments/display_alignment_list'); ?>
		</div>

		<!-- Add Alignment Dialog -->
		<?php echo Modules::run('alignments/get_edit_dialog'); ?>

		<!-- Edit Alignment Dialog -->
		<?php echo Modules::run('alignments/get_add_dialog'); ?>

		<!-- Confirm Delete Alignment Dialog -->
		<?php echo Modules::run('alignments/get_delete_dialog'); ?>

		<!-- Mass Edit Alignments Dialog -->
		<?php echo Modules::run('alignments/get_mass_edit_dialog'); ?>