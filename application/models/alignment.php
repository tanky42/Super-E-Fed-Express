<?php

class Alignment extends DataMapper {
	//var $has_one = array('lname');

	var $validation = array(
		'description'	=> array(
			'label'	=>	'Description',
			'rules'	=>	array('required', 'trim', 'unique')
		)
	);

	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}