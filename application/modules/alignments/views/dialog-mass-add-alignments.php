		<div id="massAddAlignmentsDialog" class="dialogDiv" title="Mass Add Alignments">
			<?php
			$attr = array("id" => "frmMassAddAlignment");
			echo form_open("alignments/add_alignment_ajax", $attr);
			?>

				<table id="alignment_mass_add">
					<thead>
						<tr>
							<th>Alignment</th>
						</tr>
					</thead>
					<tbody>
						<!-- Form Template -->
						<tr id="frmMassAddAlignment_template">
							<td>
								<input type="text" id="frmMassAddAlignment_#index#_alignment" class="form_input" name="alignment_description[]" value="" title="Alignment Name" required="required" placeholder="Alignment" />
								<a id="frmMassAddAlignment_remove_current">
									<img class="delete" src="<?php echo base_url(); ?>css/sheep/images/cross.png" width="16" height="16" border="0" />
								</a>
							</td>
						</tr>
						<!-- /Form Template -->

						<!-- No forms template -->
						<tr id="frmMassAddAlignment_noforms_template">
							<td>No alignments</td>
						</tr>
						<!-- /No forms template -->
					</tbody>
				</table>

				<!-- Controls -->
				<div id="frmMassAddAlignment_controls" class="controls sheep_controls">
					<div id="frmMassAddAlignment_add" class="btn form add"><a><span>Add row</span></a></div>
					<div id="frmMassAddAlignment_add_n">
						<!-- <input id="frmMassAddAlignment_add_n_input" class="add_rows_input" type="text" size="4" /> -->
						<select id="frmMassAddAlignment_add_n_input" class="add_rows_select">
							<?php for ($i = 1; $i <= 10; $i++): ?>
							<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
							<?php endfor; ?>
						</select>
						<div id="frmMassAddAlignment_add_n_button" class="btn form add"><a><span>Add multiple rows</span></a></div>
					</div>
				</div>
				<!-- /Controls -->
			<?php
			echo form_close();
			?>
		</div>