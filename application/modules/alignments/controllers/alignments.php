<?php

class Alignments extends MX_Controller {

	function __construct()
	{
		parent::__construct();
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
		$header['page_title'] = "Alignments";
		$this->load->view('../../../views/dashboard/header', $header);

		// Load Index
		$this->load->view('index-alignments', $data);

		// Load Footer
		$this->load->view('../../../views/dashboard/footer');
	}

	function display_alignment_list()
	{
		$a = new Alignment();

		$data['alignments'] = $a->get();
		$data['num_alignments'] = $a->result_count();

		if ($data['num_alignments'] == 0)
		{
			$data['alignments'] = "There are no alignments";
		}

		return $this->load->view('alignment-list', $data, TRUE);
	}

	/*******************************************************************
		Display Dialogs
	*******************************************************************/

	function get_add_dialog()
	{
		//$this->load->view('dialog-add-alignment');
		$this->load->view('dialog-mass-add-alignments');
	}

	function get_edit_dialog()
	{
		$this->load->view('dialog-edit-alignment');
	}

	function get_delete_dialog()
	{
		$this->load->view('dialog-confirm-delete-alignment');
	}

	function get_mass_edit_dialog()
	{
		$this->load->view('dialog-mass-edit-alignments');
	}

	function get_mass_delete_dialog()
	{
		$this->load->view('dialog-mass-delete-alignments');
	}

	/*******************************************************************
		Ajax Functions
	*******************************************************************/

	function add_alignment_ajax()
	{
		if (isset($_POST['alignment_description']))
		{
			$desc = $this->input->post('alignment_description');
		
			$success = 0;
			$message = '';
			$new_items = '';

			foreach ($desc as $d)
			{
				$a = new Alignment();
				$a->description = $d;

				if ($a->save())
				{
					$message .= "<p>$d was successfully saved</p>";

					$new_items .= '<li class="new_item">';
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
					$message = "<p>$d was <strong>not</strong> successfully saved</p>";
					$message .= "<p>" . $a->error->description . "</p>";
				}
			}

			$data = array(
				'success'	=> $success,
				'message'	=> $message,
				'new_items'	=> $new_items
			);

			echo json_encode($data);
		}
		else
		{
			redirect("/alignments/index");
		}
	}

	function update_alignment_ajax()
	{
		if (isset($_POST['alignment_id']))
		{
			if (!is_array($_POST['alignment_id']))
			{
				$id = array($this->input->post('alignment_id'));
				$desc = array($this->input->post('edit_description'));
			}
			else
			{
				$id = $this->input->post('alignment_id');
				$desc = $this->input->post('edit_description');
			}

			$success = 0;
			$message = "";
			$info = array();

			$idx = 0;

			foreach($id as $item)
			{
				$a = new Alignment();
				$a->where('id', $item)->get();

				$a->description = $desc[$idx];				

				if ($a->save())
				{
					$success = 1;
					$message .= "<p>$desc[$idx] was successfully updated</p>";

					$info[] = array(
						'id'	=> $a->id,
						'desc'	=> $desc[$idx]
					);
				}
				else
				{
					$message .= "<p>$desc[$idx] was <strong>not</strong> successfully updated</p>";
					$message .= "<p>" . $a->error->description . "</p>";
				}

				$idx++;
			}

			$info = json_encode($info);

			$data = array(
				"success"	=> $success,
				"message"	=> $message,
				"info"		=> $info
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

				$message .= "<p>$desc has been deleted</p>";
			}

			$data = array(
				"message"	=> $message
			);

			echo json_encode($data);
		}
		else
		{
			redirect("/alignments/index");
		}
	}
}