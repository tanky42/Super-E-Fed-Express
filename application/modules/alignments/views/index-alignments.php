		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/forms/screen.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/forms/dropdown.css">

		<link href="<?php echo base_url(); ?>css/validate/validationEngine.jquery.css" rel="stylesheet" type="text/css" />

		<link href="<?php echo base_url(); ?>css/see-modules/see.alignments.css" rel="stylesheet" type="text/css" />

		<!-- <script type="text/javascript" src="<?php echo base_url(); ?>js/forms/helpers.js"></script> -->
		<!-- <script type="text/javascript" src="<?php echo base_url(); ?>js/forms/date.js"></script> -->
		<!-- <script type="text/javascript" src="<?php echo base_url(); ?>js/forms/form.js"></script> -->

		<script type="text/javascript" src="<?php echo base_url(); ?>js/forms/jquery.form.js"></script>

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

			if ($("#temp_input").length == 0)
			{
				$("#main").append("<input type='hidden' id='temp_input' value='' />");
			}

			$(".mass-remove-icon").live("click", function() {
				if ($(this).closest("tbody").children().length > 1)
				{
					$(this).closest("tr").remove();
				}
				else
				{
					$(this).closest("div").dialog("close");
				}
			});

			$(".mass-delete-remove").live("click", function() {
				var temp_id = $(this).prev().val();

				$(".marked_for_mass").each(function() {
					var mfm_id = $(this).children("input").last().val();

					if (temp_id == mfm_id)
					{
						$(this).children("input").first().trigger("click");
					}
				});
			});
		});
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

		.mass-remove-icon {
			float: right;
		}

		.dialog-notice {
			display: inline-block;
		}

		.btnAdditionalRow {
			margin-right: 25px;
		}
		</style>

		<div id="alignments_list" class="settings_list">
			<?php echo Modules::run('alignments/display_alignment_list'); ?>
		</div>

		<!-- Mass Add Alignments Dialog -->
		<?php echo Modules::run('alignments/get_mass_add_dialog'); ?>

		<!-- Confirm Delete Alignment Dialog -->
		<?php echo Modules::run('alignments/get_delete_dialog'); ?>

		<!-- Mass Edit Alignments Dialog -->
		<?php echo Modules::run('alignments/get_mass_edit_dialog'); ?>

		<!-- Mass Delete Alignments Dialog -->
		<?php echo Modules::run('alignments/get_mass_delete_dialog'); ?>