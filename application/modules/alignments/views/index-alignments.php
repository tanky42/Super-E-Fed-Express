<!doctype html>
<html>
<head>
	<title>Alignments</title>
	<link href="<?php echo base_url(); ?>css/jquery-ui/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/forms/screen.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/forms/dropdown.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/forms/button.css">

	<link href="<?php echo base_url(); ?>css/validate/validationEngine.jquery.css" rel="stylesheet" type="text/css" />

	<link href="<?php echo base_url(); ?>css/stylesheet.css" rel="stylesheet" type="text/css" />

	<!-- <script type="text/javascript" src="<?php echo base_url(); ?>js/forms/helpers.js"></script> -->
	<!-- <script type="text/javascript" src="<?php echo base_url(); ?>js/forms/date.js"></script> -->
	<!-- <script type="text/javascript" src="<?php echo base_url(); ?>js/forms/form.js"></script> -->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/jquery-ui.min.js"></script>

	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.inputhints.min.js"></script>

	<script type="text/javascript" src="<?php echo base_url(); ?>js/validate/languages/jquery.validationEngine-en.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/validate/jquery.validationEngine.js"></script>

	<script>
	$(function() {
		$("#frmAddAlignment").validationEngine();
		$("#frmUpdateAlignment").validationEngine();

		//$("input[title]").inputHints();

		$('.submitBtn2').hover(
			// mouseover
			function(){ $(this).addClass('submitBtnHover'); },
				
			// mouseout
			function(){ $(this).removeClass('submitBtnHover'); }
		);

		$("#btnSubmit").click(function(e) {
			e.preventDefault();

			if ($("#frmAddAlignment").validationEngine("validate"))
			{
				$.post("<?php echo base_url(); ?>index.php/alignments/add_alignment_ajax",
					{
						"btnSubmit"		: "TRUE",
						"alignment_description"	: $("#alignment_description").val()
					},
					function(data) {
						clear_flash();

						var alignment = jQuery.parseJSON(data);

						if (alignment.success == 1 || alignment.success == "1")
						{
							var new_item = "<li>";
							new_item += "<a href='#' class='alignment_name'>" + $("#alignment_description").val() + "</a>";
							new_item += "<input type='hidden' value='" + alignment.id + "' />";
							new_item += "</li>";

							$("#alignments").append(new_item);

							$("#flash").show().fadeIn(400).addClass("message_success").html(alignment.message).delay(5000).fadeOut(1000);
						}
						else
						{
							$("#flash").show().fadeIn(400).addClass("message_error").html(alignment.message).delay(5000).fadeOut(1000);
						}

						$("#alignment_description").val('');
					}
				);
			}
		});

		if ($("#flash").html() != "")
		{
			$("#flash").addClass("has_messages");
		}

		$("#editAlignmentDialog").dialog({
			autoOpen: false,
			resizable: false,
			buttons: {
				"Update": function() {
					if ($("#frmUpdateAlignment").validationEngine("validate"))
					{
						$.post("<?php echo base_url(); ?>index.php/alignments/update_alignment_ajax",
							{
								"btnSubmit"		: "TRUE",
								"alignment_id"		: $("#alignment_id").val(),
								"alignment_description"	: $("#edit_description").val()
							},
							function(data) {
								clear_flash();

								var alignment = jQuery.parseJSON(data);

								if (alignment.success == 1 || alignment.success == "1")
								{
									$(".editing").text($("#edit_description").val()).removeClass("editing");

									$("#flash").show().fadeIn(400).addClass("message_success").html(alignment.message).delay(5000).fadeOut(1000);
								}
								else
								{
									$("#flash").show().fadeIn(400).addClass("message_error").html(alignment.message).delay(5000).fadeOut(1000);
								}

								$("#editAlignmentDialog").dialog("close");
							}
						);
					}
				},
				"Delete": function() {
					$("#confirmDeleteAlignmentDialog").find("span").last().text($("#edit_description").val());
					$("#confirmDeleteAlignmentDialog").dialog("open");
				},
				Cancel: function() {
					$(".editing").removeClass("editing");

					$(this).dialog("close");
				}
			}
		});

		$("#confirmDeleteAlignmentDialog").dialog({
			autoOpen: false,
			resizable: false,
			height: 190,
			modal: true,
			buttons: {
				"Delete Alignment": function() {
					$.post("<?php echo base_url(); ?>index.php/alignments/delete_alignment_ajax",
						{
							"btnSubmit"	: "TRUE",
							"alignment_id"	: $("#alignment_id").val()
						},
						function(data) {
							clear_flash();

							$("#flash").show().fadeIn(400).addClass("message_success").html(data).delay(5000).fadeOut(1000);

							$(".editing").parent().remove();
						}
					);

					$(this).dialog("close");
					$("#editAlignmentDialog").dialog("close");
				},
				Cancel: function() {
					$(this).dialog("close");
				}
			}
		});

		$(".alignment_name").live("click", function(e) {
			e.preventDefault();

			$(this).addClass("editing");

			var alignment = $(this).text();
			var alignment_id = $(this).next().val();

			$("#edit_description").val(alignment);
			$("#alignment_id").val(alignment_id);

			$("#editAlignmentDialog").dialog("open");
		});
		
		$(".list_button").button();
	});

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
	</script>
	
	<style>
	#alignments {
		list-style: none;
	}
	
	.alignment_name {
		font-size: 16px;
		margin-right: 15px;
		text-decoration: none;
	}
	
	#test_list {
		list-style: none;
		width: 30%;
	}
	
	#test_list li {
		display: block;
		line-height: 20px;
		margin-bottom: 5px;
		padding: 5px;
	}
	
	#test_list li input {
		width: auto;
		margin: 0px 25px 0px 15px;
		vertical-align: middle;
	}
	
	.item_name {
		font-size: 18px;
		vertical-align: middle;
	}
	
	.list_button {
		float: right;
	}
	
	.clear {
		clear: both;
	}
	</style>
</head>
<body>
	<div id="flash">
		<?php echo $this->session->flashdata('form_message'); ?>
	</div>
	
	<p>
		<div class="list_header">
			<h1>Alignments</h1>
			<div class="list_buttons">
				<button class="list_button">Delete Checked</button>
				<button class="list_button">Add Alignment</button>
			</div>
			<div class="clear"></div>
		</div>
		<ul id="test_list">
			<li>
				<input type="checkbox" name="delete[]" class="delete_check" value="1" />
				<span class="item_name">Face</span>
				<button class="list_button delete_item">Delete</button>
				<button class="list_button edit_item">Edit</button>
				<span class="clear"></span>
			</li>
			
			<li>
				<input type="checkbox" name="delete[]" class="delete_check" value="1" />
				<span class="item_name">Heel</span>
				<button class="list_button delete_item">Delete</button>
				<button class="list_button edit_item">Edit</button>
				<span class="clear"></span>
			</li>
		</ul>
	</p>

	<p>		
		<h3>Alignments</h3>
		<ul id="alignments">
			<?php if ($num_alignments != 0): ?>
				<?php foreach ($alignments as $alignment): ?>
			<li>
				<a href="#" class="alignment_name"><?php echo $alignment->description; ?></a>
				<input type="hidden" value="<?php echo $alignment->id; ?>" />
			</li>
				<?php endforeach; ?>
			<?php endif; ?>
		</ul>
		<?php if ($num_alignments == 0): ?>
		<?php echo $alignments; ?>
		<?php endif; ?>
	</p>

	<div class="formDiv">
		<?php
		$attr = array("id" => "frmAddAlignment");
		echo form_open("alignments/add_alignment", $attr);

		echo form_fieldset("Add Alignment");

		echo form_label('Alignment: ', 'alignment_description');
		$data = array(
			'name'	=>	'alignment_description',
			'id'	=>	'alignment_description',
			'class'	=>	'form_input validate[required]',
			'value'	=>	'',
			'title'	=>	'ie Face, Heel, etc'
		);
		echo form_input($data);
		echo form_fieldset_close();
		?>
		<br />
		<?php
		unset($attr);
		$attr = array(
			"id"	=> "btnSubmit",
			"name"	=> "btnSubmit"
		);
		echo form_submit($attr, 'Add Name');
		?>
		&nbsp;&nbsp;&nbsp;
		<button value="submit" name="btnSubmit2" id="btnSubmit2" class="submitBtn" type="submit"><span>Submit</span></button> 
		<?php
		echo form_close();
		?>
	</div>

	<div id="editAlignmentDialog" title="Edit Alignment">
		<?php
		$attr = array("id" => "frmUpdateAlignment");
		echo form_open("alignments/add_alignment", $attr);
		echo form_label('Alignment: ', 'edit_description');
		$data = array(
			'name'	=> "edit_description",
			'id'	=> "edit_description",
			'class'	=>	'form_input validate[required]',
			'value'	=>	''
		);
		echo form_input($data);
		?>
		<br />
		<input type="hidden" name="alignment_id" id="alignment_id" value="" />
		<br />
		<?php echo form_close(); ?>	
	</div>

	<div id="confirmDeleteAlignmentDialog" title="Delete this alignment?">
		<p>
			<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
			"<span></span>" will be permanently deleted. Are you sure?
		</p>
	</div>
</body>
</html>