		<div id="massEditAlignmentsDialog" class="dialogDiv" title="Mass Edit Alignments">
			<?php
			$attr = array("id" => "frmMassUpdateAlignment");
			echo form_open("alignments/update_alignment_ajax", $attr);
			?>

			<table id="alignment_mass_edit">
				<thead>
					<tr>
						<th>Alignments to Edit</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="change_data">
							<input type="text" name="edit_description[]" value="" data-orig="" required="required" />
							<input type="hidden" name="alignment_id[]" value="" />
							<img class="reset" src="<?php echo base_url(); ?>css/sheep/images/reset.gif" width="16" height="16" border="0" alt="Reset" title="Reset" />
							<img class="delete mass-remove-icon" src="<?php echo base_url(); ?>css/sheep/images/cross.png" width="16" height="16" border="0" alt="Remove item" title="Remove item" />
						</td>
					</tr>
				</tbody>
			</table>

			<?php
			echo form_close();
			?>
		</div>