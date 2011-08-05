function init()
{
	set_main_size();
	$(window).resize(set_main_size);
	//$(window).resize(set_footer_position);

	//set_footer_position();

	$("#main").after("<div id='info_tables' class='hide'></div>");

	show_info_tables();

	$("#btnInfoTable").button().click(function() {
		var cur_main = $("#main").html();
		$("#flash").append("<pre></pre>");
		$("pre").text(cur_main);

		$("#main").hide();
		$("#info_tables").show();

		$("#btnShowMain").show();

		$(this).hide();
	});

	$("#btnShowMain").button().click(function() {
		$("#main").show();
		$("#info_tables").hide();
		$("#btnInfoTable").show();
		$(this).hide();
	});

	$("#flash").hover(function() {
		if ($(this).find("pre").length != 0)
		{
			$(this).css("height", "auto");
		}
	}, function() {
		$(this).css("height", "65px");
	});

	/*
	$("#flash").click(function() {
		$(this).toggleClass("expand");
	});
	*/
}

function set_footer_position()
{
	var h = $("#header");
	var f = $("#footer");

	var h_width = h.width();
	var h_pos = h.position();

	f.width(h_width);
	f.css("left", h_pos.left);
}

function show_info_tables()
{
	// Get header info
	var h = $("#header");
	var h_arr = new Array();

	h_arr[0] = "Header";

	var css = h.css("width");
	css = css.substring(0, (css.length - 2));
	var b_width = $("body").width();
	css = Math.round((css/b_width) * 100);
	css = css + "%";

	h_arr[1] = css;			// Width Percentage
	h_arr[2] = h.width();		// Width
	h_arr[3] = h.innerWidth();	// Inner Width
	h_arr[4] = h.outerWidth();	// Outer Width

	var h_offset = h.offset();

	h_arr[5] = h_offset.left;	// Offset Left
	h_arr[6] = h_offset.top;	// Offset Top

	var h_pos = h.position();

	h_arr[7] = h_pos.left;		// Position Left
	h_arr[8] = h_pos.top;		// Position Top

	// Get footer info
	var f = $("#footer");
	var f_arr = new Array();

	f_arr[0] = "Footer";

	css = f.css("width");
	css = css.substring(0, (css.length - 2));
	css = Math.round((css/b_width) * 100);
	css = css + "%";

	f_arr[1] = css;			// Width Percentage
	f_arr[2] = f.width();		// Width
	f_arr[3] = f.innerWidth();	// Inner Width
	f_arr[4] = f.outerWidth();	// Outer Width

	var f_offset = f.offset();

	f_arr[5] = f_offset.left;	// Offset Left
	f_arr[6] = f_offset.top;	// Offset Top

	var f_pos = f.position();

	f_arr[7] = f_pos.left;		// Position Left
	f_arr[8] = f_pos.top;		// Position Top

	// Get tables
	var tables = build_info_table(h_arr);
	tables += build_info_table(f_arr);

	// Append tables
	var info_tables = $("#info_tables");
	info_tables.html(tables);

	// Wrap tables in div
	$("table").wrap("<div class='tableDiv' />");

	info_tables.append("<div class='clear'></div>");
}

function build_info_table(arr)
{
	// Open table
	var table = "\t\t<table class='el_info'>\n";

	// Main Header
	table += "\t\t\t<tr>\n";
	table += "\t\t\t\t<th colspan='2'>" + arr[0] + "</th>\n";
	table += "\t\t\t</tr>\n";

	// Spacer Row
	table += "\t\t\t<tr class='spacer'>\n";
	table += "\t\t\t\t<th colspan='2'></th>\n";
	table += "\t\t\t</tr>\n";

	// Width Rows
	// Header - Width
	table += "\t\t\t<tr>\n";
	table += "\t\t\t\t<th colspan='2'>Width</th>\n";
	table += "\t\t\t</tr>\n";

	// CSS Width
	table += "\t\t\t<tr class='odd'>\n";
	table += "\t\t\t\t<td>CSS Width</td>\n";
	table += "\t\t\t\t<td>" + arr[1] + "</td>\n";
	table += "\t\t\t</tr>\n";

	// Width
	table += "\t\t\t<tr class='odd'>\n";
	table += "\t\t\t\t<td>Width</td>\n";
	table += "\t\t\t\t<td>" + arr[2] + "</td>\n";
	table += "\t\t\t</tr>\n";

	// Inner Width
	table += "\t\t\t<tr>\n";
	table += "\t\t\t\t<td>Inner Width</td>\n";
	table += "\t\t\t\t<td>" + arr[3] + "</td>\n";
	table += "\t\t\t</tr>\n";

	// Outer Width
	table += "\t\t\t<tr class='odd'>\n";
	table += "\t\t\t\t<td>OuterWidth</td>\n";
	table += "\t\t\t\t<td>" + arr[4] + "</td>\n";
	table += "\t\t\t</tr>\n";

	// Offset Rows
	// Header - Offset
	table += "\t\t\t<tr>\n";
	table += "\t\t\t\t<th colspan='2'>Offset</th>\n";
	table += "\t\t\t</tr>\n";

	// Offset Left
	table += "\t\t\t<tr class='odd'>\n";
	table += "\t\t\t\t<td>Offset Left</td>\n";
	table += "\t\t\t\t<td>" + arr[5] + "</td>\n";
	table += "\t\t\t</tr>\n";

	// Offset Top
	table += "\t\t\t<tr>\n";
	table += "\t\t\t\t<td>Offset Top</td>\n";
	table += "\t\t\t\t<td>" + arr[6] + "</td>\n";
	table += "\t\t\t</tr>\n";

	// Position Rows
	// Header - Position
	table += "\t\t\t<tr>\n";
	table += "\t\t\t\t<th colspan='2'>Position</th>\n";
	table += "\t\t\t</tr>\n";

	// Position Left
	table += "\t\t\t<tr class='odd'>\n";
	table += "\t\t\t\t<td>Position Left</td>\n";
	table += "\t\t\t\t<td>" + arr[7] + "</td>\n";
	table += "\t\t\t</tr>\n";

	// Position To
	table += "\t\t\t<tr>\n";
	table += "\t\t\t\t<td>Position Top</td>\n";
	table += "\t\t\t\t<td>" + arr[8] + "</td>\n";
	table += "\t\t\t</tr>\n";

	// Close table
	table += "\t\t</table>\n";

	return table;
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