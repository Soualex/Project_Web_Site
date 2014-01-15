<?php

namespace System\Library\Database;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Database_Handler
{
	private $config;
	private $_instances = array();
	private $_managers = array();
	
	public function __construct(\System\Core\Config $config)
	{
		$this->config = $config;
		
		// Load the databases configurations
		$config->load_database_config($this);
		
		// Instantiate the connections to databases
		foreach ($config->_database_config as $key => $config)
		{
			$method = "getConnection_".$config['dbdriver'];
			
			// Verify that the function exist
			if (method_exists($this, $method))
			{
				$this->_instances[$key] = $this->$method($config['hostname'], $config['database'], $config['username'], $config['password']);
			}
			else
			{
				show_error(500, 'Bad Configuration', '$db["'.$key.'"]["dbdriver"] value is incorrect.');
			}
		}
	}
	
	public function instanceExist($db)
	{
		return is_string($db) && array_key_exists($db, $this->_instances) && !empty($this->_instances[$db]) ? TRUE : FALSE;
	}
	
	public function getConfigOf($db, $item)
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
		
		show_error(500, 'Instance Not Found', 'Instance '.$db.' does not exist.');
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
			show_error(500, 'DataBase Error', $e->getMessage());
		}
		
		return $db;
	}
	
	public function getManager($table, $db)
	{
		if (!is_string($table) || empty($table) || !is_string($db) || empty($db))
		{
			show_error(500, 'Manager Error', 'The manager specified is invalid.');
		}
		 
		if (!isset($this->_managers[$db.'.'.$table]))
		{			
			$table = '\System\Library\Database\\'.$db.'\\'.$table.'\\'.$table.'Manager_'.$this->getConfigOf($db, 'dbdriver');
		  	$this->_managers[$db.'.'.$table] = new $table($this->getInstanceOf($db));
		}
		 
		return $this->_managers[$db.'.'.$table];
	}
}

?>