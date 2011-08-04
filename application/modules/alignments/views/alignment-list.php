		<div class="list_header">
			<h2>Alignments</h2>
			<div class="list_controls">
				<?php
				$attr = array("id" => "frmAddAlignment");
				echo form_open("alignments/add_alignment_ajax", $attr);
				?>
				<input type="text" id="addAlignment" name="alignment_description[]" value="" title="Alignment" required="required" placeholder="Alignment" />
				<button id="btnAddAlignment" class="list_button2">Add Alignment</button>

				<?php echo form_close(); ?>

				<br />

				<button class="btnSelectAll list_button2">Select All</button>
				<button class="btnDeselectAll list_button2">Deselect All</button>
				<button id="btnDeleteAlignments" class="list_button2 hide">Delete Checked</button>
			</div>
			<div class="clear"></div>
		</div>
		<ul id="alignments">
			<?php if ($num_alignments != 0): ?>
				<?php foreach ($alignments as $alignment): ?>
			<li class="inline_edit">
				<input type="checkbox" name="delete_alignment[]" class="delete_check" value="1" />
				<span class="item_name"><?php echo $alignment->description; ?></span>
				<img class="reset hide" src="<?php echo base_url(); ?>css/sheep/images/reset.gif" width="16" height="16" border="0" alt="Reset" title="Reset" />
				<input type="hidden" class="id" value="<?php echo $alignment->id; ?>" />
				<input type="hidden" class="display_order" value="<?php echo $alignment->display_order; ?>" />
				<button class="list_button delete_item">Delete</button>
				<div class="clear"></div>
			</li>
				<?php endforeach; ?>
			<?php endif; ?>
		</ul>