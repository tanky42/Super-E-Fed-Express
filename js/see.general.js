function init()
{
	set_main_size();
	$(window).resize(set_main_size);
}

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