		<div id="massAddAlignmentsDialog" class="dialogDiv" title="Mass Add Alignments">
			<?php
			$attr = array("id" => "frmMassAddAlignment");
			echo form_open("alignments/add_alignment_ajax", $attr);
			?>

			<p>
				Enter one <em><strong>Alignment</strong></em> per box

				<br /><br />

				Click the <span class="ui-icon ui-icon-closethick dialog-notice"></span> to remove an <em><strong>Alignment</em></strong>.
			</p>

			<table id="alignment_mass_add">
				<thead>
					<tr>
						<th>Alignment</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<span class="ui-icon ui-icon-closethick mass-remove-icon mass-add-remove"></span>
							<input type="text" class="form_input validate[required" name="alignment_description[]" value="" title="Alignment Name" />
							<div class="clear"></div>
						</td>
					</tr>
				</tbody>
			</table>

			<br /><br />

			<button class="btnAdditionalRow">Add Row</button>
			<button id="btnMassAdd" class="btnSubmitForm">Add</button>
			<?php
			echo form_close();
			?>
		</div>