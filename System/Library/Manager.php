<?php

namespace System\Library;

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
abstract class Manager
{
	protected $_DB_HANDLER;
	   
	public function __construct(\System\Library\DatabaseHandler $_DB_HANDLER)
	{
		$this->_DB_HANDLER = $_DB_HANDLER;
	}
	
	public function dao($dao)
	{
		if (!empty($dao) && is_string($dao))
		{
			return $this->_DB_HANDLER->getInstanceOf($dao);
		}
		
		return NULL;
	}
}

?>