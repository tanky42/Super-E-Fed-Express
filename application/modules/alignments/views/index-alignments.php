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

			$(".alignment_delete_check").live("click", function() {
				$(this).parent().toggleClass("marked_for_mass");

				control_buttons_check();

				if ($(".alignment_delete_check:checked").length == 0)
				{
					clear_mass_edit_table();
				}
			});

			if ($("#temp_input").length == 0)
			{
				$("#main").append("<input type='hidden' id='temp_input' value='' />");
			}

			$(".item_name").live("dblclick", function() {
				if ($(".inline-editing").length > 0)
				{
					cancel_inline_edit();
				}

				$(this).parent().addClass("marked_for_mass");

				var orig_val = $(this).text();

				$("#temp_input").val(orig_val);
				$(this).addClass("inline-editing");
				$(this).html("<input type='text' id='replace_input' value='" + orig_val + "' />");

				// Hide delete button and create cancel button
				$(this).siblings(".delete_item").hide();
				$(this).siblings(".edit_item").before('<button id="btnCancelInline" class="list_button">Cancel</button>');
				$(this).siblings(".edit_item").addClass("temp_edit_button").removeClass("edit_item");
				$("#btnCancelInline").button();
			});

			$("#btnCancelInline").live("click", function() {
				cancel_inline_edit();
			});

			$(".temp_edit_button").live("click", function() {
				var desc = $("#replace_input").val();
				var alignment_id = $(this).siblings("input").last().val();

				$("#edit_description").val(desc);
				$("#alignment_id").val(alignment_id);

				$("#frmUpdateAlignment").submit();
			});
		});

		function cancel_inline_edit()
		{
			$("#replace_input").remove();
			$("#btnCancelInline").parent().removeClass("marked_for_mass");
			$("#btnCancelInline").remove();
			$(".inline-editing").siblings(".delete_item").show();
			$(".temp_edit_button").addClass("edit_item").removeClass("temp_edit_button");
			$(".inline-editing").html("").text($("#temp_input").val()).removeClass("inline-editing");
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

		.mass-delete-remove {
			float: right;
		}

		.dialog-notice {
			display: inline-block;
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

		<!-- Mass Delete Alignments Dialog -->
		<?php echo Modules::run('alignments/get_mass_delete_dialog'); ?>