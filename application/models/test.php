<?php

class Test extends DataMapper {
	var $has_one = array('lname');

	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}