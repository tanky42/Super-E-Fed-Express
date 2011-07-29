		<div id="massAddAlignmentsDialog" class="dialogDiv" title="Mass Add Alignments">
			<div id="massAddAlignmentsDiv">
				<?php
				$attr = array("id" => "frmMassAddAlignment");
				echo form_open("alignments/add_alignment_ajax", $attr);
				?>

					<div class="field">
						<label>Phones</label>

						<div class="embed" style="display: block;">
							<!-- Form Template -->
							<div id="frmMassAddAlignment_template">
								<label for="frmMassAddAlignment_#index#_phone">Phone <span id="frmMassAddAlignment_label"></span></label>
								<input id="frmMassAddAlignment_#index#_phone" name="person[phones][#index#][phone]" type="text" required="required" />
								<a id="frmMassAddAlignment_remove_current">
									<img class="delete" src="<?php echo base_url(); ?>css/sheep/images/cross.png" width="16" height="16" border="0" />
								</a>
							</div>
							<!-- /Form Template -->

							<!-- No forms template -->
							<div id="frmMassAddAlignment_noforms_template">No phones</div>
							<!-- /No forms template -->

							<!-- Controls -->
							<div id="frmMassAddAlignment_controls" class="controls">
								<div id="frmMassAddAlignment_add" class="btn form add"><a><span>Add phone</span></a></div>
								<div id="frmMassAddAlignment_remove_last" class="btn form remove"><a><span>Remove</span></a></div>
								<div id="frmMassAddAlignment_remove_all" class="btn form removeAll"><a><span>Remove All</span></a></div>
								<div id="frmMassAddAlignment_add_n">
									<input id="frmMassAddAlignment_add_n_input" type="text" size="4" />
									<div id="frmMassAddAlignment_add_n_button" class="btn form add"><a><span>Add</span></a></div>
								</div>
							</div>
							<!-- /Controls -->
						</div>
					</div>
				<?php
				echo form_close();
				?>

				<div>
					<!-- <button class="btnAdditionalRow">Add Row</button> -->
					<button id="btnMassAdd" class="btnSubmitForm">Add</button>
				</div>
			</div>
		</div>