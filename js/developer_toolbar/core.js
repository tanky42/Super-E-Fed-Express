$(document).ready(function() {
	
	$(".sections").hide();
	$(".sub").hide();
	
	$(".section-link").click(function(){
		$(".section-link").removeClass("selected");
		$(this).addClass("selected");
		$(".sections").hide();
		var id = $(this).attr("id");
		$(".section-" + id).show();
		$(".sub").hide();
	});	
	
	$(".sub-link").click(function(){
		
		$(".sub").hide();
			
		var id = $(this).attr("id");
		$("." + id).show();
		
		if($(this).hasClass("hooks")){

			$(".sections").hide();
			$(".section-hooks").show();
			
			$(".section-link").removeClass("selected");
			$("#hooks").addClass("selected");
		}
		
		if($(this).hasClass("loader")){
			$(".sections").hide();
			$(".section-loader").show();
			
			$(".section-link").removeClass("selected");
			$("#loader").addClass("selected");
		}
		
		if($(this).hasClass("auto_load")){
			$(".sections").hide();
			$(".section-auto_load").show();
			
			$(".section-link").removeClass("selected");
			$("#auto_load").addClass("selected");
		}
		
		if($(this).hasClass("request_data")){
			$(".sections").hide();
			$(".section-request_data").show();
			
			$(".section-link").removeClass("selected");
			$("#request_data").addClass("selected");
		}
		if($(this).hasClass("config")){
			$(".sections").hide();
			$(".section-config").show();
			
			$(".section-link").removeClass("selected");
			$("#config").addClass("selected");
		}
	});	
});
