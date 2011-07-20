<?php

class Tests extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		//$this->load->model('character');
	}

	function index()
	{
		$this->load->helper('form');

		$data['message'] = '';

		if (isset($_POST['btnSubmit']))
		{
			$t = new Test();

			$t->name = $this->input->post('first_name');

			if ($t->save())
			{				
				$l = new Lname();
				$l->lName = $this->input->post('last_name');

				if($l->save())
				{
					$t->save($l);
				}

				$data['message'] = "Save Worked";
			}
			else
			{
				$data['message'] = "Save Failed";
			}
		}

		$t = new Test();
		$data['names'] = $t->get();

		$this->load->view("index", $data);
	}

	function index2()
	{
		$t = new Test();
		$t->where('id', 2)->get();

		echo "First name: {$t->name}<br />Last Name: {$t->lname->lName}";
	}
}