<?php

namespace System\Library;

if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Route Class
 *
 * @subpackage	Library
 * @category	Route
 */
class Route
{
	protected $id;
	protected $uri;
	protected $application;
	protected $module;
	protected $action;
	protected $varsNames = array();
	protected $vars = array();
	protected $security;
	
	public function __construct($id, $uri, $app, $module, $action, array $varsNames, $security)
	{
		$this->setId($id);
		$this->setUri($uri);
		$this->setApplication($app);
		$this->setModule($module);
		$this->setAction($action);
		$this->setVarsNames($varsNames);
		$this->setSecurity($security);
	}
	
	public function hasVarsNames()
	{
		return !empty($this->varsNames);
 	}
	   
	public function match($url)
	{
		global $CFG;
		
		if (preg_match('`^'.$CFG->getItem(CFG_GENERAL, 'base_url').$this->uri.'$`', $url, $matches))
			return $matches;
			
		return FALSE;
	}
	
	
	// SETTERS
	
	public function setId($id)
	{
		$this->id = (int) $id;
	}
	
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
		$this->varsNames = $varsNames;
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
	
	public function id()
	{
		return $this->id;
	}
	
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