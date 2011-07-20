<?php

class Lname extends DataMapper {
	var $has_many = array('test');

	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}