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