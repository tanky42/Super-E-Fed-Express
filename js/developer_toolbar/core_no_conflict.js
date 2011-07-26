var jQuery = jQuery.noConflict();

jQuery(document).ready(function() {
	
	jQuery(".sections").hide();
	jQuery(".sub").hide();
	
	jQuery(".section-link").click(function(){
		jQuery(".section-link").removeClass("selected");
		jQuery(this).addClass("selected");
		jQuery(".sections").hide();
		var id = jQuery(this).attr("id");
		jQuery(".section-" + id).show();
		jQuery(".sub").hide();
	});	
	
	jQuery(".sub-link").click(function(){
		
		jQuery(".sub").hide();
			
		var id = jQuery(this).attr("id");
		jQuery("." + id).show();
		
		if(jQuery(this).hasClass("hooks")){

			jQuery(".sections").hide();
			jQuery(".section-hooks").show();
			
			jQuery(".section-link").removeClass("selected");
			jQuery("#hooks").addClass("selected");
		}
		
		if(jQuery(this).hasClass("loader")){
			jQuery(".sections").hide();
			jQuery(".section-loader").show();
			
			jQuery(".section-link").removeClass("selected");
			jQuery("#loader").addClass("selected");
		}
		
		if(jQuery(this).hasClass("auto_load")){
			jQuery(".sections").hide();
			jQuery(".section-auto_load").show();
			
			jQuery(".section-link").removeClass("selected");
			jQuery("#auto_load").addClass("selected");
		}
		
		if(jQuery(this).hasClass("request_data")){
			jQuery(".sections").hide();
			jQuery(".section-request_data").show();
			
			jQuery(".section-link").removeClass("selected");
			jQuery("#request_data").addClass("selected");
		}
		
		if(jQuery(this).hasClass("config")){
			jQuery(".sections").hide();
			jQuery(".section-config").show();
			
			jQuery(".section-link").removeClass("selected");
			jQuery("#config").addClass("selected");
		}
	});	
});
