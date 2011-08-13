<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth');
	}

	function index()
	{
		// Load Header
		$header['page_title'] = "Alignments";
		$header['menu'] = $this->load->view('dashboard/menu', '', TRUE);
		$header['test'] = "Test test test";

		$this->load->view('dashboard/header', $header);

		// Load Index
		$this->load->view('dashboard/index');

		// Load Footer
		$this->load->view('dashboard/footer');
	}

	function index_orig()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');

			//echo "<p>Need to log in</p>";
		} else {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$this->load->view('welcome', $data);
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */