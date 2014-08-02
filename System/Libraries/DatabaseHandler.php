<?php

namespace System\Library;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class DatabaseHandler
{
	private $_instances = array();
	private $_managers = array();

	
	public function __construct()
	{		
		// Load the databases configurations
		$GLOBALS['$_CFG']->load_database_config($this);
		
		// Instantiate the connections to databases
		foreach ($GLOBALS['$_CFG']->_database_config as $key => $config)
		{
			$method = "getConnection_".$config['dbdriver'];
			
			// Verify that the function exist
			if (method_exists($this, $method))
			{
				$this->_instances[$key] = $this->$method($config['hostname'], $config['database'], $config['username'], $config['password']);
			}
			else
			{
				show_error(ERROR_LEVEL_FATAL, 'Bad Configuration', '$db["'.$key.'"]["dbdriver"] value is incorrect.');
			}
		}
	}
	
	public function instanceOfExist($db)
	{
		return is_string($db) && array_key_exists($db, $this->_instances) && !empty($this->_instances[$db]) ? TRUE : FALSE;
	}
	
	public function getConfig($db, $item)
	{		
		$dbconfig = $this->config->getItem(CFG_DATABASE, $db);
		return $dbconfig[$item];
	}
	
	public function getInstanceOf($db)
	{
		// Verify that the instance exist
		if ($this->instanceExist($db))
		{
			return $this->_instances[$db];
		}
		
		show_error(ERROR_LEVEL_FATAL, 'Instance Not Found', 'Instance '.$db.' does not exist.');
	}
	
	protected function getConnection_PDO($host, $dbname, $user, $password)
	{
		try 
		{
			$db = new \PDO('mysql:host='.$host.';dbname='.$dbname, $user, $password);
			$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		} 
		catch (PDOException $e) 
		{
			show_error(ERROR_LEVEL_FATAL, 'DataBase Error', $e->getMessage());
		}
		
		return $db;
	}
}

?>