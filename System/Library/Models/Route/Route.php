<?php

namespace System\Library\Models\Route;

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
/**
 * Route Class
 *
 * @subpackage	Library
 * @category	Route
 */
class Route extends \System\Library\Entity
{
	protected $uri;
	protected $application;
	protected $module;
	protected $action;
	protected $varsNames;
	protected $vars = array();
	protected $security;
	
	public function hasVarsNames()
	{
		return !empty($this->varsNames);
 	}
	   
	public function match($url)
	{		
		if (preg_match('`^'.$GLOBALS['$_CFG']->getItem(CFG_GENERAL, 'base_url').$this->uri.'$`', $url, $matches))
		{
			return $matches;
		}
			
		return FALSE;
	}
	
	
	// SETTERS
	
	public function setUri($uri)
	{
		if (is_string($uri))
			$this->uri = $uri;
	}
	
	public function setApplication($app)
	{
		if (is_string($app))
			$this->application = $app;
	}
	
	public function setModule($module)
	{
		if (is_string($module))
			$this->module = $module;
	}
	
	public function setAction($action)
	{
		if (is_string($action))
			$this->action = $action;
	}
	
	public function setVarsNames(array $varsNames)
	{
		if (!empty($varsNames))
		{
			$this->varsNames = explode(',', $varsNames);
		}
	}
	
	public function setVars(array $vars)
	{
		if (!empty($vars))
		{
			$this->vars = $vars;
		}
	}
	
	public function setSecurity($security)
	{
		$this->security = (int) $security;
	}
	
	
	// GETTERS
	
	public function uri()
	{
		return $this->uri;
	}
	
	public function application()
	{
		return $this->application;
	}
	
	public function module()
	{
		return $this->module;
	}
	
	public function action()
	{
		return $this->action;
	}
	
	public function varsNames()
	{
		return $this->varsNames;
	}
	
	public function vars()
	{
		return $this->vars;
	}
	
	public function security()
	{
		return $this->security;
	}
}

?>