<?php

namespace System\Core;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Application
{
	private $route;
	private $httpRequest;
	private $httpResponse;
	private $session;
	private $config;
	private $db_handler;
	private $page;

	public function __construct(\System\Library\Database\Site\Routes\Routes $route, \System\Core\HTTPRequest $httpRequest, \System\Core\HTTPResponse $httpResponse, \System\Core\Session $session, \System\Core\Config $config, \System\Library\Database\Database_Handler $db_handler) 
	{
		// Set the globals variables
		$this->route = $route;
		$this->httpRequest = $httpRequest;
		$this->httpResponse = $httpResponse;
		$this->session = $session;
		$this->config = $config;
		$this->db_handler = $db_handler;
		$this->page = new \System\Library\Page($this);
		
		// Load the application configurations
		$config->load_application_config($this);
	}
	
	protected function getController($module, $action) 
	{		
		$controllerClass = '\\Applications\\'.$this->name().'\\Modules\\'.$module.'\\'.$module.'Controller';
		
		return new $controllerClass($this, $module, $action);
	}
	
	public function run()
	{
		if ($this->session->getAttribute('rank') < $this->config->getItem(CFG_GENERAL, 'level_required_to_reach_site') || 
			$this->session->getAttribute('rank') < $this->route->security() && 
			$this->route->uri() != $this->config->getItem(CFG_GENERAL, 'authentification_URI') && 
			$this->httpRequest->getUserIP() != '127.0.0.1')
		{
			show_error(ERROR_LEVEL_ERROR, 'Acess Denied', 'The site is accessible to the users who have the required access level.');
		}
		
		// Merge Route::vars into $_GET
		$_GET = array_merge($_GET, $this->route->offsetGet('vars'));
		
		// Instantiate the modules require by the template
		$main_module = $this->getController($this->route->module(), $this->route->action());
		$main_module->execute();
		$this->page->addView('main_module', $main_module->viewPath());
		
		foreach ($this->config->getItem(CFG_APP, 'modules_require') as $module => $action)
		{
			$array_buffer = $this->getController($module, $action);
			$array_buffer->execute();
			$this->page->addView($module.'_'.$action, $array_buffer->viewPath());
			unset($array_buffer);
		}
		
		// Add the vars required by the page
		$this->page->addVar('config', $this->config);
		$this->page->addVar('session', $this->session);
		
		// Set the template
		$this->page->setTemplate(APPPATH.$this->name().'/Styles/'.$this->config->getItem(CFG_APP, 'style').'/layout.php');
		
		// The modules are loaded so we can send the page to the user
		$this->httpResponse->setPage($this->page);
		$this->httpResponse->send();
	}

	public function name() 
	{
		return $this->route->application();
	}
	
	public function httpRequest() 
	{
		return $this->httpRequest;
	}
	
	public function httpResponse() 
	{
		return $this->httpResponse;
	}
	
	public function session() 
	{
		return $this->session;
	}
	
	public function config() 
	{
		return $this->config;
	}
	
	public function db_handler() 
	{
		return $this->db_handler;
	}
	
	public function page() 
	{
		return $this->page;
	}
}

?>