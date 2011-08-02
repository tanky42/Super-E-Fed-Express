		<link href="<?php echo base_url(); ?>css/see-modules/see.alignments.css" rel="stylesheet" type="text/css" />

		<script type="text/javascript" src="<?php echo base_url(); ?>js/forms/jquery.form.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/see-modules/see.alignments.js"></script>

		<script>
		$(document).ready(function() {
			init();
			alignment_init();

			/*
			if ($("#flash").html() != "")
			{
				$("#flash").addClass("has_messages");
			}
			*/

			$("#alignments").sortable({
				axis:		"y",
				placeholder:	"ui-state-highlight",
				revert:		true,
				update:		update_display_order
			});
		});

		function update_display_order()
		{
			var updateForm = $("#frmUpdateAlignment");

			// Clear update form
			reset_update_form(updateForm);

			// Clone update form inputs and empty it
			var form_inputs = updateForm.find("input").clone();
			updateForm.empty();

			var idx = 1;

			var items = $(this).find("li");

			var changeFound = false;

			items.each(function() {
				var list_inputs = $(this).find("input");

				var desc = $(this).find(".item_name").text();
				var id = list_inputs.eq(1).val();
				var orig_display_order = list_inputs.eq(2).val();

				if (parseInt(orig_display_order) != parseInt(idx))
				{
					changeFound = true;

					var display_order = idx;

					list_inputs.eq(2).val(idx);

					var new_form_inputs = form_inputs.clone();

					new_form_inputs.eq(0).val(desc);
					new_form_inputs.eq(1).val(id);
					new_form_inputs.eq(2).val(display_order);

					updateForm.append(new_form_inputs);
				}
				else if (changeFound == true)
				{
					alert("End of changes");

					updateForm.append(new_form_inputs);

					return false;
				}

				idx++;				
			});

			updateForm.submit();

			// Reset update form
			reset_update_form(updateForm);
		}

		function reset_update_form(updateForm)
		{
			updateForm.empty();

			var inputs = '<input type="hidden" name="edit_description[]" value="" data-orig="" required="required" />';
			inputs += '<input type="hidden" name="alignment_id[]" value="" />';
			inputs += '<input type="hidden" name="display_order[]" value="" />';

			updateForm.html(inputs);
		}
		</script>

		<div id="alignments_list" class="settings_list">
			<?php echo Modules::run('alignments/display_alignment_list'); ?>
		</div>

		<!-- Confirm Edit Alignment Form -->
		<?php echo Modules::run('alignments/get_edit_form'); ?>

		<!-- Confirm Delete Alignment Dialog -->
		<?php echo Modules::run('alignments/get_delete_dialog'); ?>

		<!-- Mass Delete Alignments Dialog -->
		<?php echo Modules::run('alignments/get_mass_delete_dialog'); ?>