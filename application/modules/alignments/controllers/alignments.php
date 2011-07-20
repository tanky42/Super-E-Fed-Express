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

		$this->load->view('index-alignments', $data);
	}

	function add_alignment()
	{
		if (isset($_POST['btnSubmit']))
		{
			$desc = $this->input->post('alignment_description');

			$a = new Alignment();
			$a->description = $desc;

			if ($a->save())
			{
				$message = "<p>$desc was successfully saved</p>";
				$this->session->set_flashdata('form_message', $message);
			}
			else
			{
				$message = "<p>$desc was <strong>not</strong> successfully saved</p>";
				$message .= "<p>" . $a->error->description . "</p>";
				$this->session->set_flashdata('form_message', $message);
			}
		}

		redirect("/alignments/index");
	}

	function add_alignment_ajax()
	{
		if (isset($_POST['btnSubmit']))
		{
			$desc = $this->input->post('alignment_description');

			$a = new Alignment();
			$a->description = $desc;

			if ($a->save())
			{
				$message = "<p>$desc was successfully saved</p>";

				$data = array(
					'success'	=> 1,
					'message'	=> $message,
					'id'		=> $a->id
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
		if (isset($_POST['btnSubmit']))
		{
			$id = $this->input->post('alignment_id');
			$desc = $this->input->post('alignment_description');

			$a = new Alignment();
			$a->where('id', $id)->get();

			$a->description = $desc;

			if ($a->save())
			{
				$message = "<p>$desc was successfully updated</p>";

				$data = array(
					'success'	=> 1,
					'message'	=> $message,
					'id'		=> $a->id
				);
				
			}
			else
			{
				$message = "<p>$desc was <strong>not</strong> successfully updated</p>";
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

	function delete_alignment_ajax()
	{
		if (isset($_POST['btnSubmit']))
		{
			$id = $this->input->post('alignment_id');

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