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
	private $page;
	private $EntitiesHandler;

	public function __construct(\System\Library\Entities\Route\Route $route, \System\Core\HTTPRequest $httpRequest, \System\Core\HTTPResponse $httpResponse, \System\Core\Session $session, \System\Core\Config $config, \System\Library\EntitiesHandler $EntitiesHandler) 
	{
		// Set the globals variables
		$this->route = $route;
		$this->httpRequest = $httpRequest;
		$this->httpResponse = $httpResponse;
		$this->session = $session;
		$this->config = $config;
		$this->page = new \System\Library\Page($this);
		$this->EntitiesHandler = $EntitiesHandler;
		
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
		// Check the user's access
		if ($this->route->uri() != $this->config->getItem(CFG_GENERAL, 'error_uri'))
		{
			if ($this->session->getAttribute('rank') < $this->config->getItem(CFG_GENERAL, 'level_required_to_reach_site') && $this->route->uri() != $this->config->getItem(CFG_GENERAL, 'authentification_URI'))
			{
				show_error(ERROR_LEVEL_ERROR, 'Accès Refusé', 'Vous n\'avez pas le niveau requis pour naviguer sur ce site. Veuillez vous connecter pour obtenir un éventuel accès.');
			}
			
			if ($this->session->getAttribute('rank') < $this->route->security())
			{
				show_error(ERROR_LEVEL_ERROR, 'Accès Refusé', 'Vous n\'avez pas le niveau requis pour accéder à cette page.');
			}
		}
		
		// Merge Route::vars into $_GET
		$_GET = array_merge($_GET, $this->route->offsetGet('vars'));
		
		// Instantiate the modules require by the template
		$main_view = $this->getController($this->route->module(), $this->route->action());
		$main_view->execute();
		$this->page->addView('main_view', $main_view->view_path);
		
		foreach ($this->config->getItem(CFG_APP, 'modules_require') as $module => $action)
		{
			$array_buffer = $this->getController($module, $action);
			$array_buffer->execute();
			$this->page->addModule_view($module.'_'.$action, $array_buffer->view_path);
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
	
	public function entities_handler() 
	{
		return $this->EntitiesHandler;
	}
	
	public function page() 
	{
		return $this->page;
	}
}

?>