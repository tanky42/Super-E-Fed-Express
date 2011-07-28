function init()
{
	set_main_size();
	$(window).resize(set_main_size);
}

/********************************************************
*							*
*	Other						*
*							*
********************************************************/

function set_main_size()
{
	var w_oHeight = $(window).height();
	var h_oHeight = $("header").outerHeight(true);
	var f_oHeight = $("footer").outerHeight(true);
	var mo_oHeight = $("#main").outerHeight(true);

	var m_oHeight = w_oHeight - (h_oHeight + f_oHeight) - 80;

	$("#main").height(m_oHeight);
}

function clear_flash()
{
	$("#flash").empty();

	if ($("#flash").hasClass("message_success"))
	{
		$("#flash").removeClass("message_success");
	}

	if ($("#flash").hasClass("message_error"))
	{
		$("#flash").removeClass("message_error");
	}
}

function display_flash_message(theMessage, newClass, removeMessage)
{
	if ($("#flash").hasClass("ui-state-highlight"))
	{
		var origClass = "ui-state-highlight";
	}
	else
	{
		var origClass = "message_default";
	}

	//alert("Orig Class: " + origClass);

	if (removeMessage)
	{
		$("#flash").switchClass(origClass, newClass, 500, function() {
			$("#flash").append(theMessage);

			if (origClass == "ui-state-highlight")
			{
				origClass = "message_default";
			}
		}).delay(3000)
		.switchClass(newClass, origClass, 1000, function() {
			$("#flash").children().each(function() {
				$(this).fadeOut('slow').remove();
			});
		});

		if ($("#flash").hasClass("ui-state-highlight"))
		{
			$("#flash").removeClass("ui-state-highlight");
		}

		if (!$("#flash").hasClass("message_default"))
		{
			$("#flash").addClass("message_default");
		}
	}
	else
	{
		$("#flash").switchClass(origClass, newClass, 500, function() {
			$("#flash").append(theMessage);
		});
	}
}

function animate_list_item(item_class, new_class, delay_length, animate_length)
{
	if (delay_length == 0)
	{
		delay_length = 3000;
	}

	if (animate_length == 0)
	{
		animate_length == 1000;
	}

	$("." + item_class).each(function() {
		$(this).delay(delay_length).switchClass(item_class, new_class, animate_length, "easeOutBounce", function() {
				$("." + new_class).removeClass(new_class);
			}).children("button").button();
	});
}

function display_ajax_loader()
{
	var theMessage = '<p><img class="ajax-loader" src="' + base_url + 'js/images/ajax-loader.gif" alt="Content is loading" />Content is loading</p>';
	display_flash_message(theMessage, "ui-state-highlight", false)
}

function check_for_ajax_loader()
{
	if ($(".ajax-loader").length != 0)
	{
		$(".ajax-loader").parent().remove();
	}
}

function select_input_text(theInput)
{
	theInput.select();
}