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
}

function alignment_add_form()
{
	var new_alignment = '';

	$("#frmAddAlignment").ajaxForm({
		clearForm:	true,
		resetForm:	true,
		beforeSubmit: function() {
			new_alignment = $("#alignment_description").val();
		},
		success: function(responseText, statusText, xhr, $form) {
			var alignment = jQuery.parseJSON(responseText);

			if (alignment.success == 1)
			{
				$("#alignments_list").empty().html(alignment.list).find("button").button();

				$("#alignments").children().each(function() {
					if ($(this).children("input").last().val() == alignment.id)
					{
						$(this).addClass("new_item").delay(5000)
							.switchClass("new_item", "temp_class", 1000, "easeOutBounce", function() {
								$(".temp_class").removeClass("temp_class");
							}).children("button").button();
					}
				});

				$("#flash").show().fadeIn(400).addClass("message_success").html(alignment.message).delay(5000)
					.switchClass("message_success", "temp_class", 1000, "easeOutBounce", function() {
						$(".temp_class").removeClass("temp_class");
						$("#flash").empty();
					});
			}
			else
			{
				$("#flash").show().fadeIn(400).addClass("message_error").html(alignment.message).delay(5000)
					.switchClass("message_error", "temp_class", 1000, "easeOutBounce", function() {
						$(".temp_class").removeClass("temp_class");
						$("#flash").empty();
					});
			}

			$("#addAlignmentDialog").dialog("close");
		}
	});
}

function alignment_update_form()
{
	var updated_alignment = '';

	$("#frmUpdateAlignment").ajaxForm({
		clearForm:	true,
		resetForm:	true,
		beforeSubmit: function() {
			updated_alignment = $("#edit_description").val();
		},
		success: function(responseText, statusText, xhr, $form) {
			var alignment = jQuery.parseJSON(responseText);

			if (alignment.success == 1)
			{
				$("#alignments_list").empty().html(alignment.list).find("button").button();

				var alignment_ids = jQuery.parseJSON(alignment.id);

				$.each(alignment_ids, function(k, v) {
					$("#alignments").children().each(function() {
						if ($(this).children("input").last().val() == v)
						{
							$(this).addClass("new_item").delay(5000)
								.switchClass("new_item", "temp_class", 1000, "easeOutBounce", function() {
									$(".temp_class").removeClass("temp_class");
								}).children("button").button();
						}
					});
				});				

				$("#flash").show().fadeIn(400).addClass("message_success").html(alignment.message).delay(5000)
					.switchClass("message_success", "temp_class", 1000, "easeOutBounce", function() {
						$(".temp_class").removeClass("temp_class");
						$("#flash").empty();
					});
			}
			else
			{
				$("#flash").show().fadeIn(400).addClass("message_error").html(alignment.message).delay(5000)
					.switchClass("message_error", "temp_class", 1000, "easeOutBounce", function() {
						$(".temp_class").removeClass("temp_class");
						$("#flash").empty();
					});
			}

			$("#editAlignmentDialog").dialog("close");
		}
	});
}

function alignment_delete_form()
{
	$("#frmDeleteAlignment").ajaxForm({
		clearForm:	true,
		resetForm:	true,
		success: function(responseText, statusText, xhr, $form) {
			$(".editing").parent().addClass("message_error").delay(5000).hide('slow', function() { $(this).remove();});

			$("#flash").show().fadeIn(400).addClass("message_success").html(responseText).delay(5000)
				.switchClass("message_success", "temp_class", 1000, "easeOutBounce", function() {
					$(".temp_class").removeClass("temp_class");
					$("#flash").empty();
				});

			$("#confirmDeleteAlignmentDialog").dialog("close");
		}
	});
}