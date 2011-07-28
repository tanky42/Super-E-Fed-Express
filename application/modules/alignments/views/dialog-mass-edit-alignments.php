		<div id="massEditAlignmentsDialog" class="dialogDiv" title="Mass Edit Alignments">
			<?php
			$attr = array("id" => "frmMassUpdateAlignment");
			echo form_open("alignments/update_alignment_ajax", $attr);
			?>

			<table id="alignment_mass_edit">
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
							<input type="text" name="edit_description[]" value="" />
							<input type="hidden" name="alignment_id[]" value="" />
						</td>
					</tr>
				</tbody>
			</table>

			<br /><br />

			<button id="btnMassClear" class="btnClearForm">Clear</button>

			&nbsp;&nbsp;&nbsp;

			<button id="btnMassEdit" class="btnSubmitForm">Make Changes</button>
			<?php
			echo form_close();
			?>
		</div>