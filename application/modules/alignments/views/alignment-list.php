				<div class="grid_24">
					<div id="alignments_list" class="settings_list grid_12">
						<div class="list_header">
							<h2>Alignments</h2>

							<div class="list_controls">
								<?php
								$attr = array("id" => "frmAddAlignment");
								echo form_open("alignments/add_alignment_ajax", $attr);
								?>
									<input type="text" id="addAlignment" name="alignment_description[]" value="" title="Alignment" required="required" placeholder="Alignment" />
									<button id="btnAddAlignment" class="add_button">Add Alignment</button> 
								</form>

								<div class="control_buttons"> 
									<button class="btnSelectAll list_button2">Select All</button>
									<button class="btnDeselectAll list_button2">Deselect All</button>
									<button id="btnDeleteAlignments" class="list_button2 btnDeleteSelected">Delete Checked</button>
								</div>
							</div>
						</div>

						<ul id="alignments">

							<?php if ($num_alignments != 0): ?>
								<?php foreach ($alignments as $alignment): ?>

							<li class="inline_edit grid_24">
								<div class="grid_2" style="text-align: center;">
									<input type="checkbox" name="delete_alignment[]" class="delete_check" value="1" />
								</div>

								<div class="grid_2" style="text-align: right;">
									<button class="list_button delete_item">Delete</button>
								</div>

								<div class="grid_19">
									<span class="item_name"><?php echo $alignment->description; ?></span>
									<!-- <img class="reset hide" src="images/reset.gif" width="16" height="16" border="0" alt="Reset" title="Reset" /> -->
									<img class="reset hide" src="<?php echo base_url(); ?>css/sheep/images/reset.gif" width="16" height="16" border="0" alt="Reset" title="Reset" />
									<input type="hidden" class="id" value="<?php echo $alignment->id; ?>" />
									<input type="hidden" class="display_order" value="<?php echo $alignment->display_order; ?>" />
								</div>
							</li>
								<?php endforeach; ?>
							<?php endif; ?>
						</ul>
					</div>
				</div>

				<script>
				$(function() {
					$(".item_name").live("dblclick", function() {});
				
					$(".add_button").button({
						icons: {
							primary:	"ui-icon-circle-plus"
						}
					});

					$(".btnSelectAll").button();
					$(".btnDeselectAll").button();
					$(".btnDeleteSelected").button();

					$(".delete_item").button({
						icons: {
							primary: "ui-icon-trash"
						},
						text: false
					});

					$(".inline_reset").button({
						icons: {
							primary: "ui-icon-arrowrefresh-1-e"
						},
						text: false
					});


					$(".inline_save").button({
						icons: {
							primary: "ui-icon-disk"
						},
						text: false
					});


					$(".inline_cancel").button({
						icons: {
							primary: "ui-icon-cancel"
						},
						text: false
					});
					
					$(".item_name").live("dblclick", function() {
						// Check that no other inline edits are open
						cancel_inline();
				
						// Add inline edit
						add_inline_edit($(this));
					});					
				});
				
				function add_inline_edit(theEl)
				{
					var item_val = theEl.text();
					var item_title = theEl.attr("title");
			
					var replace_input = '<input id="replace_input" title="' + item_title + '" data-orig="' + item_val +'" value="' + item_val +'" />';
					replace_input += '<button id="btnInlineReset">Reset</button>';
			
					var inline_buttons = '<button class="list_button1 inline_save">Save</button>';
					inline_buttons += '<button class="list_button1 inline_cancel">Cancel</button>';
			
					theEl
						.parent()
							.html(replace_input)
							.toggleClass("grid_20 grid_19")
							.prev()
								.toggleClass("grid_2 grid_3")
								.html(inline_buttons)
								.children("button")
									.first()
										.button({
											icons: {
												primary: "ui-icon-disk"
											},
											text: false
										})
										.height("20px")
										.width("20px")
									.next()
										.button({
											icons: {
												primary: "ui-icon-cancel"
											},
											text: false
										})
										.height("20px")
										.width("20px");
			
					$("#btnInlineReset").button({
						icons: {
							primary: "ui-icon-arrowrefresh-1-e"
						},
						text: false,
						create: function() {
							$(this).height("22px").width("22px");
						}
					}).click(function() {
						$(this).prev().val($(this).prev().attr("data-orig"));
					});
				}
			
				function save_inline()
				{
					var replace_input = $("#replace_input");
			
					replace_input.attr("data-orig", replace_input.val());
			
					cancel_inline();
				}
			
				function cancel_inline()
				{
					$("#replace_input").each(function() {
						var ri_parent = $(this).parent();
			
						var item_name = '<span class="item_name" title="' + $(this).attr("title") + '">' + $(this).attr("data-orig") + '</span>';
			
						var delete_button = '<button class="list_button1 delete_item">Delete</button>';
			
						ri_parent
							.toggleClass("grid_20 grid_19")
							.html(item_name)
							.prev()
								.toggleClass("grid_3 grid_2")
								.html(delete_button)
								.children("button")
									.first()
										.button({
											icons: {
												primary: "ui-icon-trash"
											},
											text: false
										})
										.height("20px")
										.width("20px");
					});
				}				
				</script>