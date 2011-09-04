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

								<div> 
									<button class="btnSelectAll control_buttons">Select All</button>
									<button class="btnDeselectAll control_buttons hidden_buttons">Deselect All</button>
									<button id="btnDeleteAlignments" class="control_buttons btnDeleteSelected hidden_buttons">Delete Checked</button>
								</div>
							</div>
						</div>

						<ul id="alignments">

							<?php if ($num_alignments != 0): ?>
								<?php foreach ($alignments as $alignment): ?>

							<li class="inline_edit">
								<input type="checkbox" name="delete_alignment[]" class="delete_check" value="1" />

<<<<<<< HEAD
								<div class="grid_2" style="text-align: center;">
									<button class="list_button delete_item inline_delete">Delete</button>
								</div>

								<div class="grid_20">
									<span class="item_name"><?php echo $alignment->description; ?></span>
									<input type="hidden" class="id" value="<?php echo $alignment->id; ?>" />
									<input type="hidden" class="display_order" value="<?php echo $alignment->display_order; ?>" />
								</div>
=======
								<button class="inline_buttons delete_item inline_delete">Delete</button>
								<button class="inline_buttons_hidden inline_save">Save</button>
								<button class="inline_buttons_hidden inline_cancel">Cancel</button>

								<span class="item_name list_data"><?php echo $alignment->description; ?></span>
								<input type="hidden" class="id list_data" value="<?php echo $alignment->id; ?>" />
								<input type="hidden" class="display_order list_data" value="<?php echo $alignment->display_order; ?>" />
>>>>>>> Fixed updating display order logic
							</li>						
								<?php endforeach; ?>
							<?php endif; ?>
						</ul>
					</div>

					<div id="confirm_alignment_delete" title="Delete Alignments?">
						<p>
							<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
							These items will be permanently deleted and cannot be recovered. Are you sure?
						</p>
					</div>
				</div>
				
				<style>
<<<<<<< HEAD
=======
				.add_button {
					margin-left: 5px;
				}

				.control_buttons {
					margin-right: 5px;
				}

>>>>>>> Fixed updating display order logic
				.inline_delete {
					height: 24px;
					width: 24px;
				}
				
				#btnInlineReset {
					margin-bottom: 5px;
					margin-left: 5px;
					vertical-align: middle;
				}
<<<<<<< HEAD
=======

				#replace_input {
					width: 70%;
				}

				.delete_check {
					margin-right: 5px;
				}
>>>>>>> Fixed updating display order logic
				</style>

				<script>
				$(function() {
					$("#confirm_alignment_delete").dialog({
						autoOpen:	false,
						resizable:	false,
						modal:		true,
						buttons: {
							"Delete Alignments": function() {
								var url = "<?php echo base_url(); ?>index.php/alignments/delete_alignment_ajax";
								mass_delete_items(url, "alignment_delete_id", $("#alignments_list"));

								$(this).dialog("close");
							},
							Cancel: function() {
								$(".delete_check:checked").prop("checked", false);
								$(".hidden_buttons").hide();

								$(this).dialog("close");
							}
						}
					});

					$(".add_button").button({
						icons: {
							primary:	"ui-icon-circle-plus"
						}
					}).live("click", function(e) {
						e.preventDefault();

						var addForm = $(this).closest("form");

						submit_add_form(addForm);
					});

					$(".btnSelectAll").button().live("click", function() {
						$(this).closest(".list_header").next().find(".delete_check").prop("checked", true);
						$(".hidden_buttons").show();
					});

					$(".btnDeselectAll").button().hide().live("click", function() {
						$(this).closest(".list_header").next().find(".delete_check").prop("checked", false);
						$(".hidden_buttons").hide();
					});

					$(".btnDeleteSelected").button().hide().live("click", function() {
						$("#confirm_alignment_delete").dialog("open");
					});

					$(".delete_check").live("click", function() {
						if ($(".delete_check:checked").length != 0)
						{
							$(".hidden_buttons").show();
						}
						else
						{
							$(".hidden_buttons").hide();
						}
					});

					$(".inline_edit").live("mouseenter", function() {
						if (!$(this).hasClass("marked_for_mass"))
						{
							$(this).addClass("ui-state-highlight");
						}
					});

					$(".inline_edit").live("mouseleave", function() {
						if (!$(this).hasClass("marked_for_mass"))
						{
							$(this).removeClass("ui-state-highlight");
						}
					});

					$(".delete_item").button({
						icons: {
							primary: "ui-icon-trash"
						},
						text: false
					}).live("click", function() {
						$(this).prev().prop("checked", true);
						$("#confirm_alignment_delete").dialog("open");
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
					
<<<<<<< HEAD
					$(".inline_delete").height("24px").width("24px");
										
					$("#alignments").sortable({
						axis:		"y",
						start: function(event, ui) {
							ui.item.addClass("ui-state-highlight");
						},
						//forcePlaceholderSize:	true,
						//placeholder:	"ui-state-highlight",
						revert:		true,
						update:		function(event, ui) {
							ui.item.removeClass("ui-state-highlight");
						}
					});		
=======
					$(".inline_buttons, .inline_buttons_hidden").height("24px").width("24px").css("margin-right", "5px");

					$("#alignments").sortable({												
						//forcePlaceholderSize:	true,
						placeholder:	"ui-state-highlight",
						//revert:	true,
						stop: function() {
							var url = "<?php echo base_url(); ?>index.php/alignments/update_alignment_ajax";
							var idName = "alignment_id";
							var orderName = "display_order";

							update_display_order(url, $(this), idName, orderName, $(this).parent());
						},
						axis:		"y"
					});

					$(".inline_buttons_hidden").hide();
>>>>>>> Fixed updating display order logic
				});

				function update_display_order(url, theEl, idName, orderName, parent)
				{
					// Set new display order for each list item
					var idx = 1;

					var ids = new Array();
					var orders = new Array();

					theEl.find("li").each(function() {
						var dspInput = $(this).find(".display_order");

						if (dspInput.val() != idx)
						{
							$(this).attr("data-oldOrder", dspInput.val()).addClass("orderUpdate");
							dspInput.val(idx);

							ids.push(parseInt($(this).find(".id").val()));
						}
						else
						{
							idx++;
						}

						orders.push(idx);

						idx++;
					});

					$.each(ids, function(index, value) {
						var id = value;
						var dsp = orders[index];

						var tempUpdate = '<input type="hidden" class="tempUpdate" name="' + idName + '[]" value="' + id + '" />';
						tempUpdate += '<input type="hidden" class="tempUpdate" name="' + orderName + '[]" value="' + dsp + '" />';

						parent.append(tempUpdate);
					});

					submit_temp_form($(".tempUpdate"), url, function() {
						$(".orderUpdate").removeAttr("data-oldOrder").removeClass("orderUpdate");
					});
				}

				function submit_temp_form(formEls, url, callback)
				{
					// Make sure no other #tempForm's exist
					if ($("#tempForm").length != 0)
					{
						$("#tempForm").each(function() {
							$(this).remove();
						});
					}

					formEls.wrapAll("<form id='tempForm' />");

					var tempForm = $("#tempForm");

					$.post(url, tempForm.serialize(), function(data) {
						callback();
					});

					tempForm.remove();
				}

				function submit_add_form(theForm)
				{
					theForm.find("input").first().removeClass("ui-state-error");

					var item_name = theForm.find("input").first().val();

					var item_list = theForm.closest(".list_header").next();
					var list_item = item_list.find("li").first().clone();
					var data_buckets = list_item.find(".list_data");

					list_item.addClass("temp_add");

					data_buckets.eq(0).text(item_name);
					data_buckets.eq(1).val("0");
					data_buckets.eq(2).val("9999");

					item_list.append(list_item);

					var temp_add = $(".temp_add");			

					$.post(theForm.attr("action"), theForm.serialize(), function(data) {
						var new_item = jQuery.parseJSON(data);

						if (new_item.id != 0)
						{
							data_buckets = temp_add.find(".list_data");

							data_buckets.eq(0).text(new_item.desc);
							data_buckets.eq(1).val(new_item.id);
							data_buckets.eq(2).val(new_item.display_order);

							temp_add.removeClass("temp_add");						

							theForm.find("input").first().val("");
						}
						else
						{
							alert("Invalid addition");

							temp_add.remove();
							theForm.find("input").first().addClass("ui-state-error").select();
						}
					});
				}

				function mass_delete_items(url, name, parent)
				{
					var ids = new Array();

					$(".delete_check:checked").each(function() {
						var idInput = $(this).siblings(".id");
						idInput.closest("li").addClass("toDelete").addClass("ui-state-error");

						ids.push(parseInt(idInput.val()));

						var tempDelete = '<input type="hidden" class="tempDelete" name="' + name + '[]" value="' + idInput.val() + '" />';
						parent.append(tempDelete);
					});

					$(".hidden_buttons").hide();

					submit_temp_form($(".tempDelete"), url, function() {
						$(".toDelete").remove();
					});
				}
				
				function add_inline_edit(theEl)
				{
					var item_val = theEl.text();
			
					var replace_input = '<input id="replace_input" data-orig="' + item_val +'" value="' + item_val +'" />';
					replace_input += '<button id="btnInlineReset">Reset</button>';
			
<<<<<<< HEAD
					var inline_buttons = '<button class="list_button1 inline_save">Save</button>';
					inline_buttons += '<button class="list_button1 inline_cancel">Cancel</button>';
			
					theEl						
						.parent()
							//.html(replace_input)
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
										.height("24px")
										.width("24px")
										.css("margin-right", "5px")
									.next()
										.button({
											icons: {
												primary: "ui-icon-cancel"
											},
											text: false
										})
										.height("24px")
										.width("24px")
									.end()
								.end()
							.end()
						.end()
					.end()
					.replaceWith(replace_input);
=======
					theEl.hide()
						.parent()
							.append(replace_input)
							.find(".inline_delete")
								.hide()
							.end()
							.find(".inline_buttons_hidden")
								.show()
								.first()									
									.button({
										icons: {
											primary: "ui-icon-disk"
										},
										text: false
										})
								.next()
									.button({
										icons: {
											primary: "ui-icon-cancel"
										},
										text: false
									});
							
>>>>>>> Fixed updating display order logic
			
					$("#btnInlineReset").button({
						icons: {
							primary: "ui-icon-arrowrefresh-1-e"
						},
						text: false,
						create: function() {
							$(this).height("24px").width("24px");
						}
					}).click(function() {
						$(this).prev().val($(this).prev().attr("data-orig"));
					});
					
					$(".inline_save").click(function() {
						save_inline();
					});
					
					$(".inline_cancel").click(function() {
						cancel_inline();
					});
<<<<<<< HEAD
=======

					$("#replace_input").select();
>>>>>>> Fixed updating display order logic
				}
			
				function save_inline()
				{
					var replace_input = $("#replace_input");
					var old_value = replace_input.attr("data-orig");
					var new_value = replace_input.val();
<<<<<<< HEAD
=======

					replace_input.siblings(".item_name").addClass("updated_item").addClass("ui-state-highlight");
>>>>>>> Fixed updating display order logic
			
					if (old_value != new_value)
					{
						replace_input.attr("data-orig", new_value);
						
						var sibs = replace_input.siblings("input");
						
						var id = sibs.first().val();
						var dspOrder = sibs.last().val();
<<<<<<< HEAD
						
=======

>>>>>>> Fixed updating display order logic
						$.post("<?php echo base_url(); ?>index.php/alignments/update_single_alignment_ajax", 
							{
								alignment_id: id,
								edit_description: new_value,
								display_order: dspOrder
							},						
							function(data) {
<<<<<<< HEAD
								alert("Data: " + data);
							
								if (parseInt(data))
								{
									$(".updated_item").removeClass("updated_item");
								}
								else
								{
									$(".updated_item").text(old_value).removeClass("updated_item");
=======
								if (parseInt(data))
								{
									animate_list_item("ui-state-highlight", "message_default", 0, 0);
									add_gritter("Alignment Updated", $(".updated_item").text() + " was updated.");
									animate_list_item("updated_item", "message_default", 0, 0);
								}
								else
								{
									$(".updated_item").text(old_value).removeClass("updated_item").addClass("ui-state-error");
									animate_list_item("ui-state-error", "message_default", 0, 0);
>>>>>>> Fixed updating display order logic
								}
							});
				
						cancel_inline();
					}
				}
			
				function cancel_inline()
				{
					$("#replace_input").each(function() {
<<<<<<< HEAD
						var ri_parent = $(this).parent();
			
						var item_name = '<span class="item_name updated_item">' + $(this).attr("data-orig") + '</span>';
									
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
										.height("24px")
										.width("24px");
=======
						var parent = $(this).closest("li");
						var item_name = $(this).attr("data-orig");

						parent
							.find(".inline_buttons_hidden")
								.hide()
							.end()
							.find(".inline_delete")
								.show()
							.end()
							.find("#replace_input")
								.next()
									.remove()
								.end()
								.remove()
							.end()
							.find(".item_name")
								.text(item_name)
								.show();
>>>>>>> Fixed updating display order logic
					});
				}				
				</script>