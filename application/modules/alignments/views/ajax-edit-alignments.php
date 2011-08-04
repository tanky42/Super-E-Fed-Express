		<div class="edit_form">
			<?php
			$attr = array("id" => "frmUpdateAlignment");
			echo form_open("alignments/update_alignment_ajax", $attr);
			?>
			<input type="hidden" name="edit_description[]" value="" data-orig="" required="required" />
			<input type="hidden" name="alignment_id[]" value="" />
			<input type="hidden" name="display_order[]" value="" />
			</form>
		</form>