<?php

namespace System\Library;

if (!defined('BASEPATH')) exit('No direct script access allowed');

abstract class BackController extends \System\Library\ApplicationComponent
{
	protected $_action;
	protected $_module;
	protected $_view;
	protected $_viewPath;
	   
	public function __construct(\System\Core\Application $app, $module, $action)
	{	
		parent::__construct($app);
		$this->setModule($module);
		$this->setAction($action);
		$this->setView($action);
	}
	   
	public function execute()
	{
		// Set the function
		$method = 'execute'.ucfirst($this->_action);
		
		// Check that the function exist
		if (!is_callable(array($this, $method)))
		{
			show_error(ERROR_LEVEL_ERROR, 'Action Not Defined', 'The action "'.$this->_action.'" is not defined on this module.');
		}
		
		// Execute the function
		$this->$method($this->app()->httpRequest());
	}
	   
	public function setModule($module)
	{
		// Check that the argument is valid
		if (!is_string($module) || empty($module))
		{
			show_error(ERROR_LEVEL_ERROR, 'Invalid Argument', 'The module must be a valid character string');
		}
		 
		$this->_module = $module;
	}
	   
	public function setAction($action)
	{
		// Check that the argument is valid
		if (!is_string($action) || empty($action))
		{
			show_error(ERROR_LEVEL_ERROR, 'Invalid Argument', 'The action must be a valid character string');
		}
		 
		$this->_action = $action;
	}
	   
	public function setView($view)
	{
		// Check that the argument is valid
		if (!is_string($view) || empty($view))
		{
			show_error(ERROR_LEVEL_ERROR, 'Invalid Argument', 'The view must be a valid character string');
		}
		 
		$this->_view = $view;
		$this->_viewPath = APPPATH.$this->app()->name().'/Modules/'.$this->_module.'/Views/'.$this->_view.'.php';
	}
	
	public function viewPath()
	{
		return $this->_viewPath;
	}
}

?>