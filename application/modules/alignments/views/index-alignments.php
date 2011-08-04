		<link href="<?php echo base_url(); ?>css/see-modules/see.alignments.css" rel="stylesheet" type="text/css" />

		<script type="text/javascript" src="<?php echo base_url(); ?>js/forms/jquery.form.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/see-modules/see.alignments.js"></script>

		<script>
		$(document).ready(function() {
			init();
			alignment_init();
		});
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