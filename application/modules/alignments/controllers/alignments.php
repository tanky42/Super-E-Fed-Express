<?php

class Alignments extends MX_Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	function test()
	{
		echo "test";
	}

	function index()
	{
		$a = new Alignment();

		$data['alignments'] = $a->get();
		$data['num_alignments'] = $a->result_count();

		if ($data['num_alignments'] == 0)
		{
			$data['alignments'] = "There are no alignments";
		}

		// Load Header
		//$header['page_title'] = "Alignments";
		//$this->load->view('../../../views/dashboard/header', $header);

		// Load Index
		$this->load->view('index-alignments', $data);

		// Load Footer
		//$this->load->view('../../../views/dashboard/footer');
	}

	function display_alignment_list()
	{
		$a = new Alignment();
		$a->order_by("display_order", "asc");

		$data['alignments'] = $a->get();
		$data['num_alignments'] = $a->result_count();

		if ($data['num_alignments'] == 0)
		{
			$data['alignments'] = "There are no alignments";
		}

		$data['edit_form_url'] = "alignments/update_alignment_ajax";

		return $this->load->view('alignment-list', $data, TRUE);
	}

	/*******************************************************************
		Display Dialogs
	*******************************************************************/
	function get_edit_form()
	{
		$this->load->view('ajax-edit-alignments');
	}

	function get_mass_add_dialog()
	{
		$this->load->view('dialog-mass-add-alignments');
	}

	function get_mass_edit_dialog()
	{
		$this->load->view('dialog-mass-edit-alignments');
	}

	function get_mass_delete_dialog()
	{
		$this->load->view('dialog-mass-delete-alignments');
	}

	function get_delete_dialog()
	{
		$this->load->view('dialog-confirm-delete-alignment');
	}

	/*******************************************************************
		Ajax Functions
	*******************************************************************/

	function add_alignment_ajax()
	{
		if (isset($_POST['alignment_description']))
		{
			$desc = $this->input->post('alignment_description');

			foreach ($desc as $d)
			{
				$a = new Alignment();
				$a->description = $d;

				if ($a->save())
				{
					//echo $a->id;
					$data = array(
						'id'		=> $a->id,
						'desc'		=> $a->description,
						'display_order'	=> 9999
					);
				}
				else
				{
					$data = array(
						'id'	=> 0
					);
				}
			}

			echo json_encode($data);
		}
	}

	function add_alignment_ajax_old()
	{
		if (isset($_POST['alignment_description']))
		{
			$desc = $this->input->post('alignment_description');

			$success = 0;
			$fail = 0;
			$s_title = '';
			$s_message = '';
			$f_title = '';
			$f_message = '';
			$new_items = '';

			$num_s = 0;
			$num_f = 0;

			foreach ($desc as $d)
			{
				$a = new Alignment();
				$a->description = $d;

				if ($a->save())
				{
					$num_s++;

					if ($num_s == 1)
					{
						$s_title = "Alignment Successfully Saved";
					}
					else
					{
						$s_title = "Alignments Successfully Saved";
					}

					$s_message .= "<p>$d was successfully saved</p>";

					$new_items .= '<li class="new_item inline_edit">';
					$new_items .= '<input type="checkbox" name="delete_alignment[]" class="alignment_delete_check" value="1" />';
					$new_items .= '<span class="item_name">' . $a->description . '</span>';
					$new_items .= '<input type="hidden" value="' . $a->id . '" />';
					$new_items .= '<button class="list_button delete_item">Delete</button>';
					$new_items .= '<div class="clear"></div>';
					$new_items .= '</li>';

					$success = 1;
				}
				else
				{
					$num_f++;

					if ($num_f == 1)
					{
						$f_title = "Alignment Was Not Saved";
					}
					else
					{
						$f_title = "Alignments Were Not Saved";
					}

					$f_message = "<p>$d was <strong>not</strong> successfully saved</p>";
					$f_message .= "<p>" . $a->error->description . "</p>";

					$fail = 1;
				}
			}

			$data = array(
				'success'	=> $success,
				's_title'	=> $s_title,
				's_message'	=> $s_message,
				'new_items'	=> $new_items,
				'fail'		=> $fail,
				'f_title'	=> $f_title,
				'f_message'	=> $f_message
			);

			echo json_encode($data);
		}
		else
		{
			redirect("/alignments/index");
		}
	}
	
	function update_single_alignment_ajax()
	{
		if (isset($_POST['alignment_id']))
		{
			$id = $this->input->post('alignment_id');

			if (isset($_POST['edit_description']))
			{
				$desc = $this->input->post('edit_description');
			}

			$display_order = $this->input->post('display_order');
			
			$a = new Alignment();
			$a->where('id', $id)->get();

			if (isset($_POST['edit_description']))
			{
				$a->description = $desc;
			}

			$a->display_order = $display_order;				

			if ($a->save())
			{
				echo "1";
			}
			else
			{
				echo "0";
			}
		}
	}

	function update_alignment_ajax()
	{
		if (isset($_POST['alignment_id']))
		{
			if (!is_array($_POST['alignment_id']))
			{
				$id = array($this->input->post('alignment_id'));
				if (isset($_POST['edit_description']))
				{
					$desc = array($this->input->post('edit_description'));
				}

				$display_order = array($this->input->post('display_order'));
			}
			else
			{
				$id = $this->input->post('alignment_id');

				if (isset($_POST['edit_description']))
				{
					$desc = $this->input->post('edit_description');
				}

				$display_order = $this->input->post('display_order');
			}

			$success = 0;
			$fail = 0;
			$s_title = '';
			$s_message = '';
			$f_title = '';
			$f_message = '';
			$info = array();

			$idx = 0;
			$num_s = 0;
			$num_f = 0;

			foreach($id as $item)
			{
				$a = new Alignment();
				$a->where('id', $item)->get();

				if (isset($_POST['edit_description']))
				{
					$a->description = $desc[$idx];
				}

				$a->display_order = $display_order[$idx];				

				if ($a->save())
				{
					$num_s++;

					if ($num_s == 1)
					{
						$s_title = "Alignment Successfully Updated";
					}
					else
					{
						$s_title = "Alignments Successfully Updated";
					}

					$success = 1;

					if (isset($_POST['edit_description']))
					{
						$s_message .= "<p>$desc[$idx] was successfully updated</p>";

						$info[] = array(
							'id'	=> $a->id,
							'desc'	=> $desc[$idx]
						);
					}
					else
					{
						$info[] = array(
							'id'	=> $a->id,
							'desc'	=> ""
						);
					}
				}
				else
				{
					$num_f++;

					if ($num_f == 1)
					{
						$f_title = "Alignment Was Not Updated";
					}
					else
					{
						$f_title = "Alignments Were Not Updated";
					}

					$fail = 1;

					if (isset($_POST['edit_description']))
					{
						$f_message .= "<p>$desc[$idx] was <strong>not</strong> successfully updated</p>";
					}

					$f_message .= "<p>" . $a->error->description . "</p>";
				}

				$idx++;
			}

			$info = json_encode($info);

			$data = array(
				"success"	=> $success,
				"s_title"	=> $s_title,
				"s_message"	=> $s_message,
				"info"		=> $info,
				"fail"		=> $fail,
				"f_title"	=> $f_title,
				"f_message"	=> $f_message,
			);

			echo json_encode($data);
		}
		else
		{
			redirect("/alignments/index");
		}
	}

	function delete_alignment_ajax()
	{
		if (isset($_POST['alignment_delete_id']))
		{
			$message = '';

			if (!is_array($_POST['alignment_delete_id']))
			{
				$id = array($this->input->post('alignment_delete_id'));
			}
			else
			{
				$id = $this->input->post('alignment_delete_id');
			}

			foreach ($id as $item)
			{
				$a = new Alignment();
				$a->where('id', $item)->get();

				$id = $a->id;
				$desc = $a->description;

				$a->delete();

				$title = "Alignment Deleted";

				$message .= "<p>$desc has been deleted</p>";
			}

			$data = array(
				"s_title"		=> $title,
				"s_message"	=> $message
			);

			echo json_encode($data);
		}
		else
		{
			redirect("/alignments/index");
		}
	}

	function delete_single_alignment_ajax()
	{
		if (isset($_POST['alignment_delete_id']))
		{
			$id = $this->input->post('alignment_delete_id');
			
			$a = new Alignment();
			$a->where('id', $id)->get();							

			if ($a->delete())
			{
				echo "1";
			}
			else
			{
				echo "0";
			}
		}
	}
}