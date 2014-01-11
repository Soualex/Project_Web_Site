<?php

namespace System\Library;

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Managers
{
	protected $_managers = array();
	protected $_db_handler;
	   
	public function __construct(\System\Library\DataBase_Handler $db_handler)
	{
		$this->_db_handler = $db_handler;
	}
	   
	public function getManagerOf($db, $table)
	{
		// Check that the variables are valid
		if (!is_string($db) || empty($db) || !is_string($table) || empty($table))
		{
			show_error(500, 'Manager Error', 'The module specified is invalid.');
		}
		
		if (!isset($this->_managers[${$db.'.'.$table}]))
		{			
			$manager = '\System\Library\Database\\'.$db.'\\'.$table.'\\'.$table.'Manager_'.$this->_db_handler->getConfigOf($db, "dbdriver");
		  	$this->_managers[${$db.'.'.$table}] = new $manager($this->_db_handler->getInstanceOf($db));
		}
		 
		return $this->_managers[${$db.'.'.$table}];
	}
}

?>