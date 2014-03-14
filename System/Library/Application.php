<?php

/*
	CLASS: Application
	PATH: System\Library
	DESCRIPTION: Script allowing to control the applications.
	LAST UPDATE: 03/11/2014
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
		
		$this->page = new \System\Library\Page($this->name(), $GLOBALS['$_CFG']->getItem(CFG_APP, 'style'));
	}
	
	private function checkSecurity()
	{
		if ($this->route->uri() != $GLOBALS['$_CFG']->getItem(CFG_GENERAL, 'error_uri'))
		{
			if ($GLOBALS['$_SESSION']->getAttribute('rank') < $GLOBALS['$_CFG']->getItem(CFG_GENERAL, 'level_required_to_reach_site') && $this->route->uri() != $GLOBALS['$_CFG']->getItem(CFG_GENERAL, 'authentification_URI'))
			{
				show_error(ERROR_LEVEL_ERROR, 'Accès Refusé', 'Vous n\'avez pas le niveau requis pour naviguer sur ce site. Veuillez vous connecter pour obtenir un éventuel accès.');
			}
			
			if ($GLOBALS['$_SESSION']->getAttribute('rank') < $this->route->security())
			{
				show_error(ERROR_LEVEL_ERROR, 'Accès Refusé', 'Vous n\'avez pas le niveau requis pour accéder à cette page.');
			}
			
			if (method_exists($this, 'additionalSecurity'))
			{
				$this->additionalSecurity();
			}
		}
	}
	
	abstract protected function additionalSecurity();
	
	private function loadModules()
	{
		// Merge "Route::vars" into $_GET
		$_GET = array_merge($_GET, $this->route->offsetGet('vars'));
		
		// Instantiate the modules require by the template
		$controllerClass = '\\Applications\\'.$this->name().'\\Modules\\'.$this->route->module().'\\'.$this->route->module().'Controller';
		$controller = new $controllerClass($this, $this->route->module(), $this->route->action());
		$controller->execute();
		$this->page->addView('main_view', $controller->view_path);
		
		foreach ($GLOBALS['$_CFG']->getItem(CFG_APP, 'modules_require') as $module => $action)
		{
			$controllerClass = '\\Applications\\'.$this->name().'\\Modules\\'.$module.'\\'.$module.'Controller';
			$controller = new $controllerClass($this, $module, $action);
			$controller->execute();
			$this->page->addModule_view($module.'_'.$action, $controller->view_path);
		}
	}
	
	public function run()
	{
		$this->checkSecurity();
		$this->loadModules();
		
		// Add globals variables to the page
		$this->page->addVar('config', $GLOBALS['$_CFG']);
		$this->page->addVar('session', $GLOBALS['$_SESSION']);
		
		// Sending the page to the user
		$GLOBALS['$_HTTPRESP']->setPage($this->page);
		$GLOBALS['$_HTTPRESP']->send();
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