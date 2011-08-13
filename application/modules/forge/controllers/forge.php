<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Forge extends MX_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth');
	}

	function index()
	{
		$this->load->helper("form");

		$tables_list = $this->_tables_list();

		$data['tables'] = array(
			"existing"	=> array(),
			"needed"	=> array()
		);

		$num_columns = 3;
		$col = 0;

		for ($i = 0; $i < $num_columns; $i++)
		{
			$data['tables']['existing'][] = array();
		} 

		foreach ($tables_list as $table)
		{
			if ($this->db->table_exists($table))
			{
				$fields = $this->db->field_data($table);

				$field_data = array();

				foreach ($fields as $field)
				{
					$field_data[] = array(
						"name"	=> $field->name,
						"type"	=> $field->type,
						"key"	=> $field->primary_key
					);
				}

				$data['tables']['existing'][$col][] = array(
					"name"		=> $table,
					"fields"	=> $field_data
				);

				$col++;

				if ($col == $num_columns)
				{
					$col = 0;
				}
			}
			else
			{	
				$data['tables']['needed'][] = $table;
			}
		}

		$this->load->view('forge', $data);
	}

	function add_tables()
	{
		$this->load->dbforge();

		$tables = $this->input->post("table_name");

		foreach ($tables as $table)
		{
			$table_data = $this->_get_table_fields($table);

			$this->dbforge->add_field($table_data['fields']);
			$this->dbforge->add_key($table_data['key'], TRUE);
			$this->dbforge->create_table($table);
		}

		redirect("/forge/index", "refresh");
	}

	function _tables_list()
	{
		$tables = array(
			"alignments",
			"classifications"
		);

		return $tables;
	}

	function _get_table_fields($table)
	{
		$key = "id";

		switch($table)
		{
			case "alignments":
				$fields = array(
					"id" => array(
						"type"			=> "INT",
						"auto_increment"	=> TRUE,
					),
					"description" => array(
						"type"		=> "VARCHAR",
						"constraint"	=> "255"
					),
					"display_order" => array(
						"type"		=> "INT",
						"default"	=> 9999
					),
				);

				break;

			case "classifications":
				$fields = array(
					"id" => array(
						"type"			=> "INT",
						"auto_increment"	=> TRUE,
					),
					"description" => array(
						"type"		=> "VARCHAR",
						"constraint"	=> "255"
					),
					"display_order" => array(
						"type"		=> "INT",
						"default"	=> 9999
					),
				);

				break;
		}

		$table_data = array(
			"key"		=> $key,
			"fields"	=> $fields
		);

		return $table_data;
	}
}

/* End of file forge.php */
/* Location: ./application/controllers/forge.php */