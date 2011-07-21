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