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
	var theMain = $("#main");

	var w_oHeight = $(window).height();
	var h_oHeight = $("header").outerHeight(true);
	var f_oHeight = $("footer").outerHeight(true);
	var mo_oHeight = theMain.outerHeight(true);

	var m_oHeight = w_oHeight - (h_oHeight + f_oHeight) - 80;

	theMain.height(m_oHeight);
}

function clear_flash()
{
	var theFlash = $("#flash");

	theFlash.empty();

	var flash_states = new Array(
		"message_success",
		"message_error",
		"ui-state-highlight",
		"ui-state-error"
	);

	for (var i = 0; i < flash_states.length; i++)
	{
		theFlash.removeClass(flash_states[i]);
	}
}

function display_flash_message(theMessage, newClass, removeMessage)
{
	var theFlash = $("#flash");

	if (theFlash.hasClass("ui-state-highlight"))
	{
		var origClass = "ui-state-highlight";
	}
	else if (theFlash.attr("class") == "")
	{
		theFlash.addClass("message_default");
		var origClass = "message_default";
	}

	if (removeMessage)
	{
		theFlash.switchClass(origClass, newClass, 500, function() {
			theFlash.append(theMessage);

			if (origClass == "ui-state-highlight")
			{
				origClass = "message_default";
			}
		}).delay(3000)
		.switchClass(newClass, origClass, 1000, function() {
			theFlash.children().each(function() {
				$(this).fadeOut('slow').remove();
			});
		});

		if (theFlash.hasClass("ui-state-highlight"))
		{
			theFlash.removeClass("ui-state-highlight");
		}

		if (!theFlash.hasClass("message_default"))
		{
			theFlash.addClass("message_default");
		}
	}
	else
	{
		theFlash.switchClass(origClass, newClass, 500, function() {
			theFlash.append(theMessage);
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

	display_flash_message(theMessage, "ui-state-highlight", false);
}

function check_for_ajax_loader()
{
	var ajaxLoader = $(".ajax-loader");

	if (ajaxLoader.length != 0)
	{
		ajaxLoader.parent().remove();
	}
}

function select_input_text(theInput)
{
	theInput.select();
}

function add_gritter(title, text)
{
	$.gritter.add({
		title:	title,
		text:	text
	});

	setTimeout("clear_flash()", 500);
}