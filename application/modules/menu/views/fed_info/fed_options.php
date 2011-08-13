				<div id="fed_option_tabs" class="grid_24">
					<ul>
						<li><a href="#membership_levels">Membership Levels</a></li>
						<li><a href="#positions">Positions</a></li>
						<li><a href="index.php/alignments">Alignments<span></span></a></li>
						<li><a href="#status_types">Status Types</a></li>
						<li><a href="#statuses">Statuses</a></li>
						<li><a href="#classifications">Classifications</a></li>
						<li><a href="#roster_splits">Roster Splits</a></li>
						<li><a href="#fed_characters">Fed Characters</a></li>
					</ul>

					<div id="membership_levels">
						<p>Membership Levels</p>
					</div>

					<div id="positions">
						<p>Positions</p>
					</div>

					<div id="status_types">
						<p>Status Types</p>
					</div>

					<div id="statuses">
						<p>Statuses</p>
					</div>

					<div id="classifications">
						<p>Classifications</p>
					</div>

					<div id="roster_splits">
						<p>Roster Splits</p>
					</div>

					<div id="fed_characters">
						<p>Fed Characters</p>
					</div>
				</div>

				<script>
				$(function() {
					var new_order = reorder_tabs($("#fed_option_tabs ul").children("li"));
					$("#fed_option_tabs ul").html(new_order);

					$("#fed_option_tabs").tabs({
						ajaxOptions: {
							cache: false,
							complete: function() {
								var selected = $("#fed_option_tabs").tabs("option", "selected");

								$("#fed_option_tabs ul li").eq(selected).find("a").find("span").text("");
							}
						},
						spinner: " - Loading"
						//cache: false
					});
				});
				</script>