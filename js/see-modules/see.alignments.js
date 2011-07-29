function alignment_init()
{
	alignment_init_validation();
	alignment_init_input_hints();
	alignment_init_dialogs();
	alignment_init_buttons();
	alignment_init_events();
	alignment_init_forms();
}

/********************************************************
*							*
*	Validation Engine				*
*							*
********************************************************/

function alignment_init_validation()
{
	$("form").validVal();
}

/********************************************************
*							*
*	Input Hints					*
*							*
********************************************************/

function alignment_init_input_hints()
{
	//$("form").myOverlay(2, 5);

	//$("#frmMassAddAlignment").myOverlay(2, 5);
	//$("#frmMassUpdateAlignment").myOverlay(2, 5);
}

/********************************************************
*							*
*	Dialogs						*
*							*
********************************************************/

function alignment_init_dialogs()
{
	alignment_mass_add_dialog();
	alignment_mass_edit_dialog();
	alignment_delete_dialog();	
	alignment_mass_delete_dialog();
}

function alignment_mass_add_dialog()
{
	$("#massAddAlignmentsDialog").dialog({
		autoOpen:	false,
		open:		function() {
			//select_first_input_text($("#alignment_mass_add"));
		},
		close:		function() {
			//var theTable = $("#alignment_mass_add");
			//alignment_clear_mass_table(theTable);

			//control_buttons_check();
		}
	});
}

function alignment_mass_edit_dialog()
{
	$("#massEditAlignmentsDialog").dialog({
		autoOpen:	false,
		open:		function() {
			select_first_input_text($("#alignment_mass_edit"));
		},
		close:		function() {
			var theTable = $("#alignment_mass_edit");
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

function select_first_input_text(theTable)
{
	select_input_text(theTable.find("input").first());
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
	var save_row = $("#alignment_mass_edit").children("tbody").children().first().clone();

	// Empty contents of cloned row
	save_row.children().first().text("");
		
	var inputs = save_row.children().last().children();
	inputs.first().val("");
	inputs.last().val("");

	// Remove all tbody rows
	$("#alignment_mass_edit").children("tbody").empty();

	// Append "cleaned" row
	$("#alignment_mass_edit").children("tbody").append(save_row);

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
	alignment_single_delete_buttons();
	alignment_mass_edit_button();
	alignment_mass_delete_button();
	set_inline_edit_buttons();

	set_general_form_buttons();

	$(".list_button, .list_button2, .btnSubmitForm, .btnClearForm, .btnAdditionalRow").button();
}

function alignment_add_button()
{
	$("#btnAddAlignment").live("click", function() {
		$("#massAddAlignmentsDialog").dialog("open");
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

			if ($("#alignment_mass_edit tbody tr td").children().first().val() != "")
			{
				var new_row = $("#alignment_mass_edit").children("tbody").children().first().clone();
				to_append = true;
			}
			else
			{
				var new_row = $("#alignment_mass_edit tbody").children().first();
			}

			var alignment_id = $(this).siblings("input").val();
			var alignment = $(this).siblings(".item_name").text();

			new_row.children().first().text(alignment);

			var inputs = new_row.children().last().children();
			inputs.first().val(alignment);
			inputs.last().val(alignment_id);

			if (to_append)
			{
				$("#alignment_mass_edit tbody").append(new_row);
			}
		});

		$("#massEditAlignmentsDialog").dialog("open");
	});
}

function alignment_mass_delete_button()
{
	$("#btnDeleteAlignments").button().live("click", function() {
		$(".alignment_delete_check:checked").each(function() {
			// Add class to parent for easy removal from list
			$(this).parent().addClass("to-delete");

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
			inputs.eq(2).val(alignment_id);

			if (to_append)
			{
				$("#alignment_mass_deletes tbody").append(new_row);
			}
		});

		$("#massDeleteAlignmentsDialog").dialog("open");
	});
}

function set_general_form_buttons()
{
	$(".btnSubmitForm").live("click", function(e) {
		e.preventDefault();

		$(this).closest("form").submit();
	});

	$(".btnClearForm").live("click", function(e) {
		e.preventDefault();

		$(this).closest(".dialogDiv").dialog("close");
	});

	/*
	$(".btnAdditionalRow").live("click", function(e) {
		e.preventDefault();

		// Clone first row of table body to duplicate
		var table_body = $(this).siblings("table").first().children("tbody");
		var new_row = table_body.children().first().clone();

		// Clear row input
		new_row.children().first().children().first().val("");

		// Append new row to table body
		table_body.append(new_row);
	});
	*/

	$("#add_alignment_add").click(function(e) {
		e.preventDefault();
	});
}

function set_inline_edit_buttons()
{
	$("#btnCancelInline").live("click", function() {
		cancel_inline_edit();
	});

	$(".temp_edit_button").live("click", function() {
		var desc = $("#replace_input").val();
		var alignment_id = $(this).siblings("input").last().val();

		$("#edit_description").val(desc);
		$("#alignment_id").val(alignment_id);

		$("#frmUpdateAlignment").submit();
	});
}

function cancel_inline_edit()
{
	$("#replace_input").remove();
	$("#btnCancelInline").parent().removeClass("marked_for_mass");
	$("#btnCancelInline").remove();
	$(".inline-editing").siblings(".delete_item").show();
	$(".temp_edit_button").remove();
	$(".inline-editing").html("").text($("#temp_input").val()).removeClass("inline-editing");
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
*	Events						*
*							*
********************************************************/

function alignment_init_events()
{
	alignment_inline_editing();
	alignment_mass_change_checkboxes();
	alignment_inline_edit_hover();
}

function alignment_inline_editing()
{
	$(".item_name").live("dblclick", function(e) {
		e.preventDefault();

		if ($(".inline-editing").length > 0)
		{
			cancel_inline_edit();
		}

		$(this).parent().addClass("marked_for_mass").addClass("ui-state-highlight");;

		var orig_val = $(this).text();

		$("#temp_input").val(orig_val);
		$(this).addClass("inline-editing");
		$(this).html("<input type='text' id='replace_input' value='" + orig_val + "' />");

		// Hide delete button and create cancel button
		$(this).siblings(".delete_item").hide();
		$(this).siblings(".delete_item").after('<button class="list_button edit_item">Edit</button>');
		$(this).siblings(".delete_item").after('<button id="btnCancelInline" class="list_button">Cancel</button>');
		$(this).siblings(".edit_item").addClass("temp_edit_button").removeClass("edit_item");
		$("#btnCancelInline, .temp_edit_button").button();
	});
}

function alignment_mass_change_checkboxes()
{
	$(".alignment_delete_check").live("click", function() {
		$(this).parent().toggleClass("marked_for_mass");

		control_buttons_check();

		if ($(".alignment_delete_check:checked").length == 0)
		{
			clear_mass_edit_table();
		}
	});
}

function alignment_inline_edit_hover()
{
	$(".inline_edit").live("hover", function() {
		if (!$(this).hasClass("marked_for_mass"))
		{
			$(this).toggleClass("ui-state-highlight");
		}
	});
}

/********************************************************
*							*
*	Forms						*
*							*
********************************************************/

function alignment_init_forms()
{
	alignment_mass_add_form();
	alignment_mass_edit_form();
	alignment_delete_form();
	alignment_mass_delete_form();
}

function alignment_mass_add_form()
{
	$("#frmMassAddAlignment").ajaxForm({
		clearForm:	true,
		resetForm:	true,
		beforeSubmit:	display_ajax_loader,
		success:	add_alignment_success
	});
}

function alignment_mass_edit_form()
{
	$("#frmMassUpdateAlignment").ajaxForm({
		clearForm:	true,
		resetForm:	true,
		beforeSubmit:	display_ajax_loader,
		success:	edit_alignment_success
	});
}

function alignment_delete_form()
{
	$("#frmDeleteAlignment").ajaxForm({
		clearForm:	true,
		resetForm:	true,
		success:	delete_alignment_success
	});
}

function alignment_mass_delete_form()
{
	$("#frmMassDeleteAlignment").ajaxForm({
		clearForm:	true,
		resetForm:	true,
		success:	delete_alignment_success
	});
}

/********************************************************
*							*
*	Forms Success					*
*							*
********************************************************/

function add_alignment_success(responseText, statusText, xhr, $form)
{
	check_for_ajax_loader();

	var alignment = jQuery.parseJSON(responseText);

	if (alignment.success == 1)
	{
		$("#alignments").append(alignment.new_items).find("button").button();

		animate_list_item("new_item", "message_default", 0, 0);

		display_flash_message(alignment.message, "message_success", true);
	}
	else
	{
		display_flash_message(alignment.message, "message_error", true);
	}

	$form.parent().dialog("close");
}

function edit_alignment_success(responseText, statusText, xhr, $form)
{
	check_for_ajax_loader();

	var alignment = jQuery.parseJSON(responseText);

	if (alignment.success == 1)
	{
		var alignment_info = jQuery.parseJSON(alignment.info);

		$.each(alignment_info, function(index) {
			var updated_item = alignment_info[index];

			if ($("#replace_input").length != 0)
			{
				$("#replace_input").remove();
				$("#btnCancelInline").remove();
				$(".temp_edit_button").remove();
			}

			$(".marked_for_mass").each(function() {
				var myId = $(this).children("input").last().val();

				if (updated_item.id == myId)
				{
					$(this).children(".item_name").removeClass("inline-editing").text(updated_item.desc);
				}

				$(this).children(".delete_item").show();
			});
		});

		animate_list_item("marked_for_mass", "message_default", 0, 0);

		display_flash_message(alignment.message, "message_success", true);
	}
	else
	{
		display_flash_message(alignment.message, "message_error", true);
	}

	$form.parent().dialog("close");
}

function delete_alignment_success(responseText, statusText, xhr, $form) 
{
	check_for_ajax_loader();

	var alignment = jQuery.parseJSON(responseText);

	$(".marked_for_mass").each(function() {
		$(this).remove();
	});

	display_flash_message(alignment.message, "message_success", true);

	$form.parent().dialog("close");
}