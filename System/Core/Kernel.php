<?php

namespace System\Core;

if (!defined('BASE_PATH')) exit('No direct script access allowed');

use System\Core\Config;
use System\Core\HTTPRequest;
use System\Core\Router;

class Kernel
{
	private $config;
	private $request;
	private $router;

	public function __construct()
	{
		$this->config 	= 	new Config();
		$this->request 	= 	new HTTPRequest();
		$this->router 	= 	new Router();

		$this->config->loadGeneralConfig();
		$this->router->loadRoutes();
	}

	public function start()
	{
		$modules = 
		$route = $this->router->getRoute($this->request->getURL());
		$_GET = array_merge($_GET, $this->route->offsetGet('vars'));

		$app = $this->getApplication($route->offsetGet('name'));
		$app->loadModules();
	}

	private function getApplication($name)
	{
		if (!is_dir(APP_PATH.$route->application()))
			exit('The application\'s directory does not exist. Please add it or remove the route.');

		$class = 'Sources\Applications\\'.$route->application().'\\'.ucfirst($route->application()).'Application';

		return new $app_class($route);
	}
}
	
?>