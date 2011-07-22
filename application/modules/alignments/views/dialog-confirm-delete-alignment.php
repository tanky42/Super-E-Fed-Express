		<div id="confirmDeleteAlignmentDialog" title="Delete this alignment?">
			<p>
				<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
				"<span></span>" will be permanently deleted. Are you sure?
			</p>

			<?php
			unset($attr);
			$attr = array("id" => "frmDeleteAlignment");
			echo form_open("alignments/delete_alignment_ajax", $attr);
			?>
			<input type="hidden" name="alignment_delete_id" id="alignment_delete_id" value="" />
			<?php
			echo form_close();
			?>
		</div>