function alignment_init()
{
	alignment_init_validation();
	alignment_init_input_hints();
	alignment_init_dialogs();
	alignment_init_buttons();
	alignment_init_forms();
}

/********************************************************
*							*
*	Validation Engine				*
*							*
********************************************************/

function alignment_init_validation()
{
	$("#frmAddAlignment").validationEngine();
	$("#frmUpdateAlignment").validationEngine();
}

/********************************************************
*							*
*	Input Hints					*
*							*
********************************************************/

function alignment_init_input_hints()
{
	//$("input[title]").inputHints();
}

/********************************************************
*							*
*	Dialogs						*
*							*
********************************************************/

function alignment_init_dialogs()
{
	alignment_add_dialog();
	alignment_edit_dialog();
	alignment_delete_dialog();

	alignment_mass_edit_dialog();
	alignment_mass_delete_dialog();
}

function alignment_add_dialog()
{
	$("#addAlignmentDialog").dialog({
		autoOpen: false
	});
}

function alignment_edit_dialog()
{
	$("#editAlignmentDialog").dialog({
		autoOpen: false,
		resizable: false,
		buttons: {
			"Update": function() {
				if ($("#frmUpdateAlignment").validationEngine("validate"))
				{
					$("#frmUpdateAlignment").submit();
				}
			},
			Cancel: function() {
				$(".editing").removeClass("editing");

				$(this).dialog("close");
			}
		}
	});
}

function alignment_delete_dialog()
{
	$("#confirmDeleteAlignmentDialog").dialog({
		autoOpen: false,
		resizable: false,
		height: 190,
		modal: true,
		buttons: {
			"Delete Alignment": function() {
				$("#frmDeleteAlignment").submit();
			},
			Cancel: function() {
				$(this).dialog("close");
			}
		}
	});
}

function alignment_mass_edit_dialog()
{
	$("#massEditAlignmentsDialog").dialog({
		autoOpen:	false,
		close:		function() {
			var theTable = $("#alignment_mass_changes");
			alignment_clear_mass_table(theTable);

			control_buttons_check();
		}
	});
}

function alignment_mass_delete_dialog()
{
	$("#massDeleteAlignmentsDialog").dialog({
		autoOpen:	false,
		close:		function() {
			var theTable = $("#alignment_mass_deletes");
			alignment_clear_mass_table(theTable);

			control_buttons_check();
		}
	});
}

/********************************************************
*							*
*	Tables						*
*							*
********************************************************/

function alignment_clear_mass_table(theTable)
{
	// First clone a row to empty and reinsert
	var save_row = theTable.children("tbody").children().first().clone();

	// Empty contents of cloned row
	save_row.children().each(function() {
		// Clear contents of each cell
		if ($(this).children().length == 0)
		{
			$(this).text("");
		}
		else
		{
			$(this).children("span").each(function() {
				$(this).text("");
			});

			$(this).children("input").val("");
		}
	});

	// Remove all tbody rows
	theTable.children("tbody").empty();

	// Append "cleaned" row
	theTable.children("tbody").append(save_row);

	// Uncheck checkboxes
	$(".alignment_delete_check:checked").each(function() {
		$(this).trigger("click");
	});
}

function clear_mass_edit_table()
{
	// First clone a row to empty and reinsert
	var save_row = $("#alignment_mass_changes").children("tbody").children().first().clone();

	// Empty contents of cloned row
	save_row.children().first().text("");
		
	var inputs = save_row.children().last().children();
	inputs.first().val("");
	inputs.last().val("");

	// Remove all tbody rows
	$("#alignment_mass_changes").children("tbody").empty();

	// Append "cleaned" row
	$("#alignment_mass_changes").children("tbody").append(save_row);

	// Uncheck checkboxes
	$(".alignment_delete_check:checked").each(function() {
		$(this).trigger("click");
	});
}

function clear_mass_delete_table()
{
	// First clone a row to empty and reinsert
	var save_row = $("#alignment_mass_deletes").children("tbody").children().first().clone();

	// Empty contents of cloned row
	var inputs = save_row.children().first().children();
	inputs.first().text("");
	inputs.eq(2).text("");
	inputs.last().val("");

	// Remove all tbody rows
	$("#alignment_mass_deletes").children("tbody").empty();

	// Append "cleaned" row
	$("#alignment_mass_deletes").children("tbody").append(save_row);

	// Uncheck checkboxes
	$(".alignment_delete_check:checked").each(function() {
		$(this).trigger("click");
	});
}

/********************************************************
*							*
*	Buttons						*
*							*
********************************************************/

function alignment_init_buttons()
{
	alignment_add_button();
	alignment_single_edit_buttons();
	alignment_single_delete_buttons();
	alignment_mass_edit_button();
	alignment_mass_delete_button();

	set_alignment_mass_changes_dialog_buttons();

	$(".list_button, .list_button2").button();
}

function alignment_add_button()
{
	$("#btnAddAlignment").live("click", function() {
		$("#addAlignmentDialog").dialog("open");
	});
}

function alignment_single_edit_buttons()
{
	$(".edit_item").live("click", function() {
		var alignment_id = $(this).siblings("input").last().val();
		$("#alignment_id").val(alignment_id);

		var alignment = $(this).siblings(".item_name").text();
		$("#edit_description").val(alignment);

		$(this).siblings(".item_name").addClass("editing");

		$("#editAlignmentDialog").dialog("open");
	});
}

function alignment_single_delete_buttons()
{
	$(".delete_item").live("click", function() {
		var alignment_id = $(this).siblings("input").last().val();
		$("#alignment_delete_id").val(alignment_id);

		var alignment = $(this).siblings(".item_name").text();
		$("#confirmDeleteAlignmentDialog").find("span").last().text(alignment);

		$(this).siblings(".item_name").addClass("editing");

		$("#confirmDeleteAlignmentDialog").dialog("open");
	});
}

function alignment_mass_edit_button()
{
	$("#btnEditAlignments").live("click", function() {
		$(".alignment_delete_check:checked").each(function() {
			var to_append = false;

			if ($("#alignment_mass_changes tbody tr td").children().first().val() != "")
			{
				var new_row = $("#alignment_mass_changes").children("tbody").children().first().clone();
				to_append = true;
			}
			else
			{
				var new_row = $("#alignment_mass_changes tbody").children().first();
			}

			var alignment_id = $(this).siblings("input").val();
			var alignment = $(this).siblings(".item_name").text();

			new_row.children().first().text(alignment);

			var inputs = new_row.children().last().children();
			inputs.first().val(alignment);
			inputs.last().val(alignment_id);

			if (to_append)
			{
				$("#alignment_mass_changes tbody").append(new_row);
			}
		});

		$("#massEditAlignmentsDialog").dialog("open");
	});
}

function alignment_mass_delete_button()
{
	$("#btnDeleteAlignments").button().live("click", function() {
		$(".alignment_delete_check:checked").each(function() {
			var to_append = false;

			if ($("#alignment_mass_deletes tbody tr td").children().first().text() != "")
			{
				var new_row = $("#alignment_mass_deletes").children("tbody").children().first().clone();
				to_append = true;
			}
			else
			{
				var new_row = $("#alignment_mass_deletes tbody").children().first();
			}

			var alignment_id = $(this).siblings("input").val();
			var alignment = $(this).siblings(".item_name").text();

			var inputs = new_row.children().first().children();
			inputs.first().text(alignment);
			inputs.eq(1).val(alignment);
			inputs.last().val(alignment_id);

			if (to_append)
			{
				$("#alignment_mass_deletes tbody").append(new_row);
			}
		});

		$("#massDeleteAlignmentsDialog").dialog("open");
	});
}

function set_alignment_mass_changes_dialog_buttons()
{
	$("#btnMassClear").button().click(function(e) {
		e.preventDefault();

		$("#massEditAlignmentsDialog").dialog("close");
	});

	$("#btnMassEdit").button().click(function(e) {
		e.preventDefault();				
				
		$("#frmMassUpdateAlignment").submit();
	});
}

// Show/Hide mass edit/delete buttons
function control_buttons_check()
{
	var num_checked = $(".alignment_delete_check:checked").length;

	if (num_checked == 0 && $("#btnDeleteAlignments").is(":visible"))
	{
		$("#btnEditAlignments").hide();
		$("#btnDeleteAlignments").hide();
	}
	else if (num_checked > 0 && $("#btnDeleteAlignments").not(":visible"))
	{
		$("#btnEditAlignments").show();
		$("#btnDeleteAlignments").show();
	}
}

/********************************************************
*							*
*	Forms						*
*							*
********************************************************/

function alignment_init_forms()
{
	alignment_add_form();
	alignment_update_form();
	alignment_delete_form();
	alignment_mass_add_form();
	alignment_mass_edit_form();
	alignment_mass_delete_form();
}

function alignment_add_form()
{
	var new_alignment = '';

	$("#frmAddAlignment").ajaxForm({
		clearForm:	true,
		resetForm:	true,
		success: add_alignment_success
	});
}

function alignment_update_form()
{
	var updated_alignment = '';

	$("#frmUpdateAlignment").ajaxForm({
		clearForm:	true,
		resetForm:	true,
		success: edit_alignment_success
	});
}

function alignment_delete_form()
{
	$("#frmDeleteAlignment").ajaxForm({
		clearForm:	true,
		resetForm:	true,
		success: delete_alignment_success
	});
}

function alignment_mass_add_form()
{
}

function alignment_mass_edit_form()
{
	$("#frmMassUpdateAlignment").ajaxForm({
		clearForm:	true,
		resetForm:	true,
		success: edit_alignment_success
	});
}

function alignment_mass_delete_form()
{
}

/********************************************************
*							*
*	Forms Success					*
*							*
********************************************************/

function add_alignment_success(responseText, statusText, xhr, $form)
{
	var alignment = jQuery.parseJSON(responseText);

	if (alignment.success == 1)
	{
		$("#alignments").append(alignment.new_items).find("button").button();

		$(".new_item").each(function() {
			$(this).delay(3000).switchClass("new_item", "temp_class", 1000, "easeOutBounce", function() {
					$(".temp_class").removeClass("temp_class");
				}).children("button").button();
		});

		display_flash_message(alignment.message, "message_success");
	}
	else
	{
		display_flash_message(alignment.message, "message_error");
	}

	$form.parent().dialog("close");
}

function edit_alignment_success(responseText, statusText, xhr, $form)
{
	var alignment = jQuery.parseJSON(responseText);

	if (alignment.success == 1)
	{
		var alignment_info = jQuery.parseJSON(alignment.info);

		$.each(alignment_info[1], function(k, v) {
			kalert("K: " + k + "\nV: " + v);

			$(".marked_for_mass").each(function() {
				var myId = $(this).children("input").last().val();

				alert ("My ID: " + myId + "\nItem ID: " + updated_item.id);

				if (updated_item.id == myId)
				{
					$(this).children(".item_name").val(updated_item.desc);
				}
			});
		});

		$(".marked_for_mass").each(function() {
			$(this).delay(3000).switchClass("marked_for_mass", "temp_class", 1000, "easeOutBounce", function() {
					$(".temp_class").removeClass("temp_class");
				}).children("button").button();
		});

		display_flash_message(alignment.message, "message_success");
	}
	else
	{
		display_flash_message(alignment.message, "message_error");
	}

	$form.parent().dialog("close");
}

function delete_alignment_success(responseText, statusText, xhr, $form) 
{
	var alignment = jQuery.parseJSON(responseText);

	$("#alignments_list").empty().html(alignment.list).find("button").button();

	display_flash_message(alignment.message, "message_success");

	$form.parent().dialog("close");
}