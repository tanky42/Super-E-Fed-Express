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

		// Load Dialogs
		//$this->load->view('dialog-add-alignment');
		//$this->load->view('dialog-edit-alignment');
		//$this->load->view('dialog-confirm-delete-alignment');
		//$this->load->view('dialog-mass-edit-alignments');

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
		$this->load->view('dialog-add-alignment');
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

	/*******************************************************************
		Ajax Functions
	*******************************************************************/

	function add_alignment_ajax()
	{
		if (isset($_POST['btnSubmit']))
		{
			$desc = $this->input->post('alignment_description');

			$a = new Alignment();
			$a->description = $desc;

			if ($a->save())
			{
				$list = $this->display_alignment_list();

				$message = "<p>$desc was successfully saved</p>";

				$data = array(
					'success'	=> 1,
					'message'	=> $message,
					'id'		=> $a->id,
					'list'		=> $list
				);
				
			}
			else
			{
				$message = "<p>$desc was <strong>not</strong> successfully saved</p>";
				$message .= "<p>" . $a->error->description . "</p>";

				$data = array(
					'success'	=> 0,
					'message'	=> $message
				);
			}

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
			$ids = array();

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
					$ids[] = $a->id;				
				}
				else
				{
					$message .= "<p>$desc[$idx] was <strong>not</strong> successfully updated</p>";
					$message .= "<p>" . $a->error->description . "</p>";
				}

				$idx++;
			}

			$ids = json_encode($ids);

			$list = $this->display_alignment_list();

			$data = array(
				"success"	=> $success,
				"message"	=> $message,
				"id"		=> $ids,
				"list"		=> $list
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
			$id = $this->input->post('alignment_delete_id');

			$a = new Alignment();
			$a->where('id', $id)->get();

			$desc = $a->description;

			$a->delete();

			echo "<p>$desc has been deleted</p>";
		}
		else
		{
			redirect("/alignments/index");
		}
	}
}