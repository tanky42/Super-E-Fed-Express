		<div class="list_header">
			<h2>Alignments</h2>
			<div class="list_controls">
				<button id="btnAddAlignment" class="list_button2">Add Alignment</button>
				<button id="btnEditAlignments" class="list_button2 hide">Edit Checked</button>
				<button id="btnDeleteAlignments" class="list_button2 hide">Delete Checked</button>			
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
		<ul id="alignments">
			<?php if ($num_alignments != 0): ?>
				<?php foreach ($alignments as $alignment): ?>
			<li class="inline_edit">
				<input type="checkbox" name="delete_alignment[]" class="alignment_delete_check" value="1" />
				<span class="item_name"><?php echo $alignment->description; ?></span>
				<input type="hidden" value="<?php echo $alignment->id; ?>" />
				<button class="list_button delete_item">Delete</button>
				<div class="clear"></div>
			</li>
				<?php endforeach; ?>
			<?php endif; ?>
		</ul>