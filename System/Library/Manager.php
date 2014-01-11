<?php

namespace System\Library;

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
abstract class Manager
{
	protected $dao;
	   
	public function __construct($dao)
	{
		$this->dao = $dao;
	}
}

?>