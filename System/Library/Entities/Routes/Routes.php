<?php

namespace System\Library\Database\Site\Routes;

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
/**
 * Route Class
 *
 * @subpackage	Library
 * @category	Route
 */
class Routes extends \System\Library\Entity
{
	protected $uri;
	protected $application;
	protected $module;
	protected $action;
	protected $varsNames = array();
	protected $vars = array();
	protected $security;
	
	public function hasVarsNames()
	{
		return !empty($this->varsNames);
 	}
	   
	public function match($url)
	{
		global $CFG;
		
		if (preg_match('`^'.$CFG->getItem(CFG_GENERAL, 'base_url').$this->uri.'$`', $url, $matches))
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
	
	public function setVarsNames($varsNames)
	{
		if (!empty($vars))
		{
			$this->varsNames = explode(',', $varsNames);
		}
	}
	
	public function setVars(array $vars)
	{
		$this->vars = $vars;
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
		return isset($this->varsNames) ? $this->varsNames : NULL;
	}
	
	public function vars()
	{
		return isset($this->vars) ? $this->vars : NULL;
	}
	
	public function security()
	{
		return $this->security;
	}
}

?>