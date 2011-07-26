		<div id="massDeleteAlignmentsDialog" title="Mass Delete Alignments">
			<?php
			$attr = array("id" => "frmMassDeleteAlignment");
			echo form_open("alignments/delete_alignment_ajax", $attr);
			?>

			<p>
				<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
				The following <em><strong>Alignments</em></strong> will be permantently deleted.

				<div class="clear"></div>

				Click the <span class="ui-icon ui-icon-closethick dialog-notice"></span> to prevent an <em><strong>Alignment</em></strong> from being deleted.
			</p>

			<table id="alignment_mass_deletes">
				<thead>
					<tr>
						<th>Alignment</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="change_data">
							<span></span>
							<input type="hidden" name="alignment_description[]" value="" />
							<input type="hidden" name="alignment_id[]" value="" />
							<span class="ui-icon ui-icon-closethick mass-delete-remove"></span>
							<div class="clear"></div>
						</td>
					</tr>
				</tbody>
			</table>

			<br /><br />

			<button id="btnMassDelete">Delete</button>
			<?php
			echo form_close();
			?>
		</div>