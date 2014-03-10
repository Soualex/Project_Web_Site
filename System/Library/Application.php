<?php

/*
	CLASS: Application
	PATH: System\Core
	DESCRIPTION: Script allowing to control the applications.
	LAST UPDATE: 03/03/2014
	AUTHORS: Soulalex
*/

namespace System\Library;

if (!defined('BASEPATH')) exit('No direct script access allowed');

abstract class Application
{
	private $route;
	private $page;

	public function __construct(\System\Library\Models\Route\Route $route) 
	{
		$this->route = $route;
		
		// Load the application configurations
		$GLOBALS['$_CFG']->load_application_config($this);
		
		$this->page = new \System\Library\Page($this->name(), $config->getItem(CFG_APP, 'style'));
	}
	
	private function getController($module, $action) 
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
		}
		
		// Add the vars required by the page
		$this->page->addVar('config', $this->config);
		$this->page->addVar('session', $this->session);
		
		// The modules are loaded so we can send the page to the user
		$this->httpResponse->setPage($this->page);
		$this->httpResponse->send();
	}

	public function name() 
	{
		return $this->route->application();
	}
	
	public function page() 
	{
		return $this->page;
	}
}

?>