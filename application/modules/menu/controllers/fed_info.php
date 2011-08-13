<?php

class Fed_Info extends MX_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function general_settings()
	{
		echo $this->load->view('fed_info/general_settings', '', TRUE);
	}

	function fed_options()
	{
		echo $this->load->view('fed_info/fed_options', '', TRUE);
	}

	function shows()
	{
		echo $this->load->view('fed_info/shows', '', TRUE);
	}

	function titles()
	{
		echo $this->load->view('fed_info/titles', '', TRUE);
	}

	function awards()
	{
		echo $this->load->view('fed_info/awards', '', TRUE);
	}

	function links()
	{
		echo $this->load->view('fed_info/links', '', TRUE);
	}

	function matches()
	{
		echo $this->load->view('fed_info/matches', '', TRUE);
	}

	function rankings()
	{
		echo $this->load->view('fed_info/rankings', '', TRUE);
	}
}