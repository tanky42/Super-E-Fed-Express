		<div id="addAlignmentDialog" title="Add Alignment">
			<?php
			$attr = array("id" => "frmAddAlignment");
			echo form_open("alignments/add_alignment_ajax", $attr);

			echo form_fieldset("Add Alignment");

			echo form_label('Alignment: ', 'alignment_description');
			$data = array(
				'name'		=> 'alignment_description',
				'id'		=> 'alignment_description',
				'class'		=> 'form_input validate[required]',
				'value'		=> '',
				'title'		=> 'ie Face, Heel, etc',
				'required'	=> 'required',
				'placeholder'	=> 'Alignment'
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