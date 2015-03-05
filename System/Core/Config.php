<?php

/*
	CLASS: Config
	PATH: System\Core
	DESCRIPTION: Script allowing to manage the configurations.
	LAST UPDATE: 03/03/2014
	AUTHORS: Soulalex
*/

namespace System\Core;

use System\Library\DatabaseHandler;
use System\Core\Application;

if (!defined('BASE_PATH')) exit('No direct script access allowed');

class Config
{
	const CFG_GENERAL = 1;
	const CFG_APP = 2;
	const CFG_DATABASE = 3;
	
	public static $_general_config = array();
	public static $_application_config = array();
	public static $_database_config = array();
	
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
			case self::CFG_GENERAL:
				return isset($this->_general_config[$item]) ? $this->_general_config[$item] : NULL;

			case self::CFG_APP:
				return isset($this->_application_config[$item]) ? $this->_application_config[$item] : NULL;
			
			case self::CFG_DATABASE:
				return isset($this->_database_config[$item]) ? $this->_database_config[$item] : NULL;
				
			default:
				show_error(500, 'Invalid Argument', 'The value you passed on the argument "$config_type" is not avalible.');
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
				
			default:
				show_error(500, 'Invalid Argument', 'The value you passed on the argument "$config_type" is not avalible.');
				break;
		}
	}
	
	/**
	 * Load the generals configurations file
	 *
	 * @access	public
	 * @return	void
	 */
	public function loadGeneralConfig()
	{
		if (!file_exists(CFG_PATH.'Config.xml'))
			exit('The configuration file does not exist.');

		$xml = new \DOMDocument;
		$xml->load(CFG_PATH.'Config.xml');

		$configs = $xml->getElementsByTagName('config');
		
		foreach ($configs as $key => $val)
			$this->setItem(self::CFG_GENERAL, $key, $val);

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
				$base_url = 'http://localhost';

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
	public function load_application_config(Application $app)
	{
		// Fetch the config file
		if (!file_exists(BASEPATH.'Config/Applications.php'))
			show_error(500, 'Missing Configuration File', 'The configuration file does not exist.');

		require_once(BASEPATH.'Config/Applications.php');

		// Does the $config array exist in the file?
		if (!isset(${strtolower($app->name())}) || !is_array(${strtolower($app->name())}))
			show_error(500, 'Configuration Error', 'Your config file does not appear to be formatted correctly.');
		
		foreach (${strtolower($app->name())} as $key => $val)
			$this->setItem(self::CFG_APP, $key, $val);
	}
	
	/**
	 * Load the application configurations file
	 *
	 * @access	public
	 * @param	DataBase_Handler
	 * @return	void
	 */
	public function load_database_config(DatabaseHandler $db_handler)
	{
		// Fetch the config file
		if (!file_exists(BASEPATH.'Config/Database.php'))
			show_error(500, 'Missing Database File', 'The database file does not exist.');

		require(BASEPATH.'Config/Database.php');

		// Does the $config array exist in the file?
		if (!isset($db) || !is_array($db))
			show_error(500, 'Configuration Error', 'Your database file does not appear to be formatted correctly.');
		
		foreach ($db as $key => $val)
		{
			if (isset($db[$key]))
					$this->setItem(self::CFG_DATABASE, $key, $val);
		}
	}
}

?>