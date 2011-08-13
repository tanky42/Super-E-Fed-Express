function alignment_init()
{
	//alignment_init_sheepit(); // SheepIt has to be called before ValidVal
	alignment_init_validation();
	alignment_init_dialogs();
	//alignment_sortable_init();
	//alignment_init_buttons();
	//alignment_init_events();
	//alignment_init_forms();
}

/********************************************************
*							*
*	Validation Engine				*
*							*
********************************************************/

// Create variables for validated forms
var validated_add_alignment, validated_edit_alignment;

function alignment_init_validation()
{
	validated_add_alignment = 
		$("#frmAddAlignment").validVal({
			validate:		{
				onBlur:		false,
				onSubmit:	true
			},
			invalidFormFunc:	build_valid_val_error
		});

	validated_edit_alignment =
		$("#frmUpdateAlignment").validVal({
			validate:		{
				onBlur:		false,
				onSubmit:	true,
				hiddenFields:	true
			},
			invalidFieldFunc:	inline_edit_validation_error,
			invalidFormFunc:	build_valid_val_error
		});
}

function inline_edit_validation_error($field, $form, language)
{
	$("#replace_input").addClass("invalid");
}

function build_valid_val_error(field_arr, $form, language)
{
	var list = "";

	for (var i = 0; i < field_arr.length; i++)
	{
		var theField = field_arr[i]

		if (theField.attr("title"))
		{
			list += "\t" + theField.attr("title");
		}
		else
		{
			alert("Attention, not all the fields have been filled out correctly.");
			return false;
		}

		if (theField.hasClass("email"))
		{
			list += " - Must be a valid email address";
		}

		if (theField.hasClass("number"))
		{
			list += " - Must be a number";
		}

		if (theField.hasClass("url"))
		{
			list += " - Must be a valid URL";
		}

		list += "\n";
	}

	var f = "field";

	if (field_arr.length > 1)
	{
		f = "fields";
	}

	alert("Please complete the following " + f + ":\n" + list);
}

/********************************************************
*							*
*	Dialogs						*
*							*
********************************************************/

function alignment_init_dialogs()
{
	alignment_delete_dialog();	
	alignment_mass_delete_dialog();
}

function alignment_mass_delete_dialog()
{
	$("#massDeleteAlignmentsDialog").dialog({
		autoOpen:	false,
		buttons: {
			"Delete Alignments": function() {
				$(this).find("form").submit();
				$(this).dialog("close");
			},
			Cancel: function() {
				var theList = $(this).find("form").find(".mass_delete_list").first();
				clear_mass_delete_list(theList);

				remove_classes($(".to-delete"));

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
				$(this).find("form").submit();
				$(this).dialog("close");
			},
			Cancel: function() {
				// Clear span
				$(this).find("form").prev().find("span").last().text("");

				// Clear hidden ID input
				$(this).find("form").find("input").each(function() {
					$(this).val("");
				});

				remove_classes($(".to-delete"));
				
				$(this).dialog("close");
			}
		}
	});
}

function select_first_input_text(theTable)
{
	select_input_text(theTable.find("input").first());
}

function clear_sheep_table(theTable)
{
	var theBody = theTable.find("tbody");
	var numChildren = theBody.children().length;

	while (theBody.children().length > 2)
	{
		theBody.children().eq(theBody.children().length - 2).remove();
	}

	theTable.next().find(".add_rows_select").children().first().attr("selected", "selected");

	theTable.closest("form").validVal();
}

/********************************************************
*							*
*	Sortables					*
*							*
********************************************************/

function alignment_sortable_init()
{
	$("#alignments").sortable({
		axis:		"y",
		placeholder:	"ui-state-highlight",
		revert:		true,
		update:		alignment_update_display_order
	});
}

function alignment_update_display_order()
{
	var updateForm = $("#frmUpdateAlignment");

	// Clear update form
	alignment_reset_update_form(updateForm);

	// Clone update form inputs and empty it
	var form_inputs = updateForm.find("input").clone();
	updateForm.empty();

	var idx = 1;

	var items = $(this).find("li");

	var changeFound = false;

	items.each(function() {
		var list_inputs = $(this).find("input");

		var desc = $(this).find(".item_name").text();
		var id = list_inputs.eq(1).val();
		var orig_display_order = list_inputs.eq(2).val();

		if (parseInt(orig_display_order) != parseInt(idx))
		{
			changeFound = true;

			var display_order = idx;

			list_inputs.eq(2).val(idx);

			var new_form_inputs = form_inputs.clone();

			new_form_inputs.eq(0).val(desc);
			new_form_inputs.eq(1).val(id);
			new_form_inputs.eq(2).val(display_order);

			updateForm.append(new_form_inputs);
		}
		else if (changeFound == true)
		{
			updateForm.append(new_form_inputs);

			return false;
		}

		idx++;				
	});

	updateForm.submit();

	// Reset update form
	alignment_reset_update_form(updateForm);
}

function alignment_reset_update_form(updateForm)
{
	updateForm.empty();

	var inputs = '<input type="hidden" name="edit_description[]" value="" data-orig="" required="required" />';
	inputs += '<input type="hidden" name="alignment_id[]" value="" />';
	inputs += '<input type="hidden" name="display_order[]" value="" />';

	updateForm.html(inputs);
}

/********************************************************
*							*
*	Tables						*
*							*
********************************************************/

function clear_mass_delete_list(theList)
{
	// First clone a row to empty and reinsert
	var save_row = theList.children().first().clone();

	// Empty contents of cloned row
	var children = save_row.children();
	children.eq(1).text("");
	children.eq(2).val("");
	children.eq(3).val("");

	// Remove all tbody rows
	theList.empty();

	// Append "cleaned" row
	theList.append(save_row);

	// Uncheck checkboxes
	$(".delete_check:checked").each(function() {
		$(this).trigger("click");
	});

	control_buttons_check();
}

/********************************************************
*							*
*	Buttons						*
*							*
********************************************************/

function alignment_init_buttons()
{
	alignment_select_all();
	alignment_deselect_all();

	alignment_add_button();
	alignment_single_delete_buttons();
	alignment_mass_delete_button();
	set_inline_edit_buttons();

	set_general_form_buttons();

	$(".list_button, .list_button2, .btnSubmitForm, .btnClearForm, .btnAdditionalRow").button();
}

function alignment_select_all()
{
	$(".btnSelectAll").button().live("click", function(e) {
		e.preventDefault();

		$(this).closest(".list_header").next().find(".delete_check").each(function() {
			if (!$(this).attr("checked"))
			{
				$(this).trigger("click");
			}
		});
	});
}

function alignment_deselect_all()
{
	$(".btnDeselectAll").button().live("click", function(e) {
		e.preventDefault();

		$(this).closest(".list_header").next().find(".delete_check").each(function() {
			if ($(this).attr("checked"))
			{
				$(this).trigger("click");
			}
		});
	});
}

function alignment_add_button()
{
	$("#btnAddAlignment").live("click", function(e) {
		e.preventDefault();

		var form_data = validated_add_alignment.submitform();

		if (form_data)
		{
			$("#frmAddAlignment").submit();
		}
	});
}

function alignment_single_delete_buttons()
{
	$(".delete_item").live("click", function() {
		$(this).parent().addClass("marked_for_mass").addClass("ui-state-error").addClass("to-delete");

		var inputs = $(this).siblings("input");

		var alignment_id = inputs.eq(1).val();
		$("#alignment_delete_id").val(alignment_id);

		var alignment = inputs.eq(0).text();
		$("#confirmDeleteAlignmentDialog").find("span").last().text(alignment);

		inputs.eq(0).addClass("editing");

		$("#confirmDeleteAlignmentDialog").dialog("open");
	});
}

function alignment_mass_delete_button()
{
	$("#btnDeleteAlignments").button().live("click", function() {
		$(".delete_check:checked").each(function() {
			// Add class to parent for easy removal from list
			$(this).parent().addClass("to-delete").addClass("ui-state-error");

			var to_append = false;

			if ($("#alignment_mass_deletes ul").children().first().children("span").first().text() != "")
			{
				var new_row = $("#alignment_mass_deletes ul").children().first().clone();
				to_append = true;
			}
			else
			{
				var new_row = $("#alignment_mass_deletes ul").children().first();
			}

			var alignment_id = $(this).siblings("input").val();
			var alignment = $(this).siblings(".item_name").text();

			var children = new_row.children();
			children.eq(1).text(alignment);
			children.eq(2).val(alignment);
			children.eq(3).val(alignment_id);

			if (to_append)
			{
				$("#alignment_mass_deletes ul").append(new_row);
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

	$("#add_alignment_add").click(function(e) {
		e.preventDefault();
	});

	$(".reset").live("click", function() {
		var replace_input = $("#replace_input")
		var orig_data = replace_input.attr("data-orig");
		replace_input.val(orig_data).select();
	});

	$(".mass-remove-icon").live("click", function() {
		if ($(this).parent().get(0).tagName == "TD")
		{
			$(this).closest("tr").remove();
		}
		else if ($(this).parent().get(0).tagName == "LI")
		{
			$(this).parent().remove();
		}

		var temp_id = $(this).siblings(".id").val();

		$(".marked_for_mass").each(function() {
			var mfm_id = $(this).children(".id").val();

			if (temp_id == mfm_id)
			{
				$(this).children("input").first().trigger("click");
			}
		});
	});
}

function set_inline_edit_buttons()
{
	$("#btnCancelInline").live("click", function() {
		cancel_inline_edit();
	});

	$(".temp_edit_button").live("click", function(e) {
		e.preventDefault();

		var desc = $("#replace_input").val();
		var alignment_id = $(this).siblings(".id").val();
		var display_order = $(this).siblings(".display_order").val();

		var inputs = $("#frmUpdateAlignment").find("input");
		inputs.eq(0).val(desc);
		inputs.eq(1).val(alignment_id);
		inputs.eq(2).val(display_order);

		var form_data = validated_edit_alignment.submitform();

		if (form_data)
		{
			$("#frmUpdateAlignment").submit();
		}		
	});
}

function cancel_inline_edit()
{
	var replace_input = $("#replace_input");
	var orig_data = replace_input.attr("data-orig");
	var inlineCancel = $("#btnCancelInline");
	var inlineEditing = $(".inline-editing");
	
	replace_input.parent().siblings(".reset").hide().end().end().remove();
	inlineCancel.parent().removeClass("marked_for_mass");
	inlineCancel.remove();
	inlineEditing.siblings(".delete_item").show();
	$(".temp_edit_button").remove();
	inlineEditing.html("").text(orig_data).removeClass("inline-editing").parent().removeClass("ui-state-highlight");
}

// Show/Hide mass edit/delete buttons
function control_buttons_check()
{
	var num_checked = $(".delete_check:checked").length;

	if (num_checked == 0 && $("#btnDeleteAlignments").is(":visible"))
	{
		$("#btnDeleteAlignments").hide();
	}
	else if (num_checked > 0 && $("#btnDeleteAlignments").not(":visible"))
	{
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
	$(".inline_edit").live("dblclick", function(e) {
		e.preventDefault();

		if ($(".inline-editing").length > 0)
		{
			cancel_inline_edit();
		}

		$(this).addClass("marked_for_mass").addClass("ui-state-highlight");

		var item_name = $(this).find(".item_name");
		var delete_item = $(this).find(".delete_item");

		var orig_val = item_name.text();

		item_name.addClass("inline-editing");
		item_name.html("<input type='text' id='replace_input' value='" + orig_val + "' title='Alignment Description' data-orig='" + orig_val + "' />");

		// Hide delete button and create cancel button
		delete_item.hide();
		delete_item.after('<button class="list_button temp_edit_button">Save</button>');
		delete_item.after('<button id="btnCancelInline" class="list_button">Cancel</button>');

		$("#btnCancelInline, .temp_edit_button").button();

		$(this).find(".reset").show();

		$("#replace_input").select();
	});
}

function alignment_mass_change_checkboxes()
{
	var checkboxes = $(".delete_check");

	checkboxes.live("click", function() {
		$(this).parent().toggleClass("marked_for_mass").toggleClass("ui-state-error");		

		control_buttons_check();
	});

	checkboxes.each(function() {
		if ($(this).not(":checked"))
		{
			$(this).removeClass("marked_for_mass").removeClass("ui-state-highlight").removeClass("ui-state-error");
		}
	});
}

function alignment_inline_edit_hover()
{
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
}

function remove_classes(theElement)
{
	theElement
		.removeClass("marked_for_mass")
		.removeClass("ui-state-highlight")
		.removeClass("ui-state-error")
		.removeClass("to-delete");
}

/********************************************************
*							*
*	SheepIt Forms					*
*							*
********************************************************/

function alignment_init_sheepit()
{
	//alignment_mass_add_sheepit();	
}

function alignment_mass_add_sheepit()
{
	$("#frmMassAddAlignment").sheepIt({
		separator:		"",
		allowRemoveLast:	true,
		allowRemoveCurrent:	true,
		allowRemoveAll:		true,
		allowAdd:		true,
		allowAddN:		true,
		maxFormsCount:		10,
		minFormsCount:		1,
		iniFormsCount:		1,
		afterAdd: function(source, newForm) {
			newForm.validVal();
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
	alignment_add_form();
	alignment_edit_form();
	alignment_delete_form();
	alignment_mass_delete_form();
}

function alignment_add_form()
{
	$("#frmAddAlignment").ajaxForm({
		clearForm:	true,
		resetForm:	true,
		beforeSubmit:	display_ajax_loader,
		success:	add_alignment_success
	});
}

function alignment_edit_form()
{
	$("#frmUpdateAlignment").ajaxForm({
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

		add_gritter(alignment.s_title, alignment.s_message);
	}

	if (alignment.fail == 1)
	{
		add_gritter(alignment.f_title, alignment.f_message);
	}
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
				$("#replace_input").parent().siblings(".reset").hide().end().end().remove();
				$("#btnCancelInline").remove();
				$(".temp_edit_button").remove();
			}

			$(".marked_for_mass").each(function() {
				var myId = $(this).children(".id").val();

				if (updated_item.id == myId)
				{
					$(this).children(".item_name").removeClass("inline-editing").text(updated_item.desc);
				}

				$(this).children(".delete_item").show();

				remove_classes($(this));
			});
		});

		animate_list_item("marked_for_mass", "temp_class", 0, 0);

		add_gritter(alignment.s_title, alignment.s_message);
	}
	
	if (alignment.fail == 1)
	{
		add_gritter(alignment.f_title, alignment.f_message);
	}
}

function delete_alignment_success(responseText, statusText, xhr, $form) 
{
	check_for_ajax_loader();

	var alignment = jQuery.parseJSON(responseText);

	$(".marked_for_mass").each(function() {
		$(this).addClass("ui-state-error").fadeOut(500, function() { $(this).remove(); });
	});

	add_gritter(alignment.s_title, alignment.s_message)

	if ($form.find("table").length != 0)
	{
	}
	else if ($form.find("ul").length != 0)
	{
		var theList = $form.find(".mass_delete_list").first();
		clear_mass_delete_list(theList);
	}
	else
	{
		// Clear span
		$form.prev().find("span").last().text("");

		// Clear hidden ID input
		$form.find("input").each(function() {
			$(this).val("");
		});
	}
}