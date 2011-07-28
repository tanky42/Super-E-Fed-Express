jQuery.fn.myOverlay = function (topNudge, leftNudge, useChangeEvent) {
	topNudge = typeof(topNudge) != 'undefined' ? topNudge : 0;
	leftNudge = typeof(leftNudge) != 'undefined' ? leftNudge : 0;
	useChangeEvent = typeof(useChangeEvent) != 'undefined' ? useChangeEvent : false;

	return this.each(function() {
		// Remove current overlay labels and divs if found
		jQuery("div.myOverlay").each(function() {
			jQuery(this).children().last().remove();
			jQuery(this).children().first().unwrap();
		});

		var curParent = jQuery(this);
		var textAreas = jQuery(this).find("textarea");
		var pass = jQuery(this).find("input[type=password]");

		jQuery(this).find("input[type=text]").add(textAreas).add(pass).each(function() {
			var relHint = jQuery(this).attr("title");
			var curValue = jQuery(this).val();
			var theInput = jQuery(this);
			var safeHint;
			var newDiv;

			var suffix = Math.floor(Math.random()*10001);

			if(relHint)
			{				
				safeHint = relHint.replace(/[^a-zA-Z0-9]/g, '');
				jQuery(this).wrap("<div class='myOverlay' style='position:relative' id='wrap" + safeHint + suffix + "' />");
				var wrap = jQuery(this).parent();
				var newPos = jQuery(this).position();
				newZ = jQuery(this).css("z-index");

				if (newZ == "auto")
				{
					newZ = "2000";
				}
				else
				{
					newZ = newZ + 20;
				}

				var newCss = {
					"position":	"absolute",
					"z-index":	newZ,
					"left":		newPos["left"] + leftNudge,
					"top":		newPos["top"] + topNudge,
					"cursor":	"text"
				};

				newDiv = jQuery(document.createElement("label"))
					.appendTo(wrap)
					//.attr("for", jQuery(this).attr("id"))
					.attr("id", safeHint + suffix)
					.addClass("myOverlay")
					.html(relHint)
					.css(newCss)
					.click(function() {
						jQuery(this).toggle(false);

						theInput.trigger("focus");
					});
			}

			if (newDiv)
			{
				if (curValue)
				{
					newDiv.toggle(false);
				}

				jQuery(this).focus(function() {
					newDiv.toggle(false);
				});

				if (useChangeEvent)
				{
					jQuery(this).change(function() {
						var element = jQuery(this);
						newDiv.toggle(jQuery(this).attr("value") == "");
					});
				}
				else
				{
					jQuery(this).blur(function() {
						if (jQuery(this).attr("value") == "")
						{
							newDiv.toggle(true);
						}
					});
				}
			}
		});
	});
}