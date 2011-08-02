		<div id="massDeleteAlignmentsDialog" class="dialogDiv" title="Mass Delete Alignments">
			<?php
			$attr = array("id" => "frmMassDeleteAlignment");
			echo form_open("alignments/delete_alignment_ajax", $attr);
			?>

			<p>
				<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
				The following <em><strong>Alignments</em></strong> will be permantently deleted.

				<div class="clear"></div>

				<!-- Click the <span class="ui-icon ui-icon-closethick dialog-notice"></span> to prevent an <em><strong>Alignment</em></strong> from being deleted. -->
			</p>

			<div id="alignment_mass_deletes">
				<h4>Alignment</h4>

				<ul class="mass_delete_list">
					<li>
						<img class="delete mass-remove-icon" src="<?php echo base_url(); ?>css/sheep/images/cross.png" width="16" height="16" border="0" alt="Remove item" title="Remove item" />
						<span></span>
						<input type="hidden" name="alignment_description[]" value="" />
						<input type="hidden" name="alignment_delete_id[]" value="" />
					</li>
				</ul>
			</div>

			<?php
			echo form_close();
			?>
		</div>