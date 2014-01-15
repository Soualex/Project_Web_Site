<?php

namespace System\Core;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Config
{
	const CFG_GENERAL = 1;
	const CFG_APP = 2;
	const CFG_DATABASE = 3;
	const CFG_SERVER = 4;
	
	public $_general_config = array();
	public $_application_config = array();
	public $_database_config = array();
	public $_server_config = array();
	
	/**
	 * Fetch a config file item
	 *
	 *
	 * @access	public
	 * @param	int		the config item type
	 * @param	string	the config item name
	 * @return	string
	 */
	public function getItem($config_type, $item)
	{
		switch ($config_type)
		{
			case CFG_GENERAL:
				return isset($this->_general_config[$item]) ? $this->_general_config[$item] : NULL;

			case CFG_APP:
				return isset($this->_application_config[$item]) ? $this->_application_config[$item] : NULL;
			
			case CFG_DATABASE:
				return isset($this->_database_config[$item]) ? $this->_database_config[$item] : NULL;
				
			case CFG_SERVER:
				return isset($this->_server_config[$item]) ? $this->_server_config[$item] : NULL;
				
			default:
				show_error(500, 'Argument Invalid', 'The value you had passed on the argument $config_type is not avalible.');
				break;
		}
	}
	
	/**
	 * Set a config file item
	 *
	 * @access	public
	 * @param	int		the config item type
	 * @param	string	the config item key
	 * @param	string	the config item value
	 * @return	void
	 */
	public function setItem($config_type, $item, $value)
	{		
		switch ($config_type)
		{
			case self::CFG_GENERAL:
				$this->_general_config[$item] = $value;
				break;
				
			case self::CFG_APP:
				$this->_application_config[$item] = $value;
				break;
			
			case self::CFG_DATABASE:
				$this->_database_config[$item] = $value;
				break;
				
			case self::CFG_SERVER:
				$this->_server_config[$item] = $value;
				break;
				
			default:
				show_error(500, 'Argument Invalid', 'The value you had passed on the argument $config_type is not avalible.');
				break;
		}
	}
	
	/**
	 * Load the generals configurations file
	 *
	 * @access	public
	 * @return	void
	 */
	public function load_general_config()
	{
		// Fetch the config file
		if (!file_exists(BASEPATH.'Config/config.php'))
		{
			show_error(500, 'Missing Configuration File', 'The configuration file does not exist.');
		}

		require_once(BASEPATH.'Config/config.php');

		// Does the $config array exist in the file?
		if (!isset($config) || !is_array($config))
		{
			show_error(500, 'Configuration Error', 'Your config file does not appear to be formatted correctly.');
		}
		
		foreach ($config as $key => $val)
		{
			if (isset($config[$key]))
			{
					$this->setItem(self::CFG_GENERAL, $key, $val);
			}
		}

		// Set the base_url automatically if none was provided
		if (empty($this->_general_config['base_url']))
		{
			if (isset($_SERVER['HTTP_HOST']))
			{
				$base_url = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
				$base_url .= '://'. $_SERVER['HTTP_HOST'];
				$base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
			}
			else
			{
				$base_url = 'http://localhost';
			}

			$this->setItem(self::CFG_GENERAL, 'base_url', $base_url);
		}
	}
	
	/**
	 * Load the application configurations file
	 *
	 * @access	public
	 * @param	Application
	 * @return	void
	 */
	public function load_application_config(\System\Core\Application $app)
	{
		// Fetch the config file
		if (!file_exists(BASEPATH.'Config/applications.php'))
		{
			show_error(500, 'Missing Configuration File', 'The configuration file does not exist.');
		}

		require_once(BASEPATH.'Config/applications.php');

		// Does the $config array exist in the file?
		if (!isset(${strtolower($app->name())}) || !is_array(${strtolower($app->name())}))
		{
			show_error(500, 'Configuration Error', 'Your config file does not appear to be formatted correctly.');
		}
		
		foreach (${strtolower($app->name())} as $key => $val)
		{
			$this->setItem(self::CFG_APP, $key, $val);
		}
	}
	
	/**
	 * Load the application configurations file
	 *
	 * @access	public
	 * @param	DataBase_Handler
	 * @return	void
	 */
	public function load_database_config(\System\Library\Database\Database_Handler $db_handler)
	{
		// Fetch the config file
		if (!file_exists(BASEPATH.'Config/database.php'))
		{
			show_error(500, 'Missing Database File', 'The database file does not exist.');
		}

		require(BASEPATH.'Config/database.php');

		// Does the $config array exist in the file?
		if (!isset($db) || !is_array($db))
		{
			show_error(500, 'Configuration Error', 'Your database file does not appear to be formatted correctly.');
		}
		
		foreach ($db as $key => $val)
		{
			if (isset($db[$key]))
			{
					$this->setItem(self::CFG_DATABASE, $key, $val);
			}
		}
	}
}

?>