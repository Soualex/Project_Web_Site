<?php

namespace System\Core;

if (!defined('BASE_PATH')) exit('No direct script access allowed');

use System\Library\Model;
use System\Library\Models\Site\Route\Route;

class Router
{	
	private static $routes = array();
	
	public function loadRoutes()
	{
		$xml = new \DOMDocument;
		$xml->load(CFG_PATH.'Routes.xml');
		    
		$base_routes = $xml->getElementsByTagName('route');

		foreach ($base_routes as $base_route)
		{
		    $xml->load(APP_PATH.$base_route->getAttribute('app').'/Config/Routes.xml');
		    
		    $routes = $xml->getElementsByTagName('route');
		    
		    foreach ($routes as $route)
		    {
			    $vars = array();

			    if ($route->hasAttribute('vars'))
			    	$vars = explode(',', $route->getAttribute('vars'));
			      
			      $this->addRoute(new Route($route->getAttribute('url'), $route->getAttribute('module'), $route->getAttribute('action'), $vars));
			}
		}
	}
	
	/**
	 * Add a route in the routes list
	 *
	 *
	 * @access	public
	 * @param	Route	the route to add
	 */
	public function addRoute(Route $route)
	{
		if (!empty($route) && !in_array($route, $this->routes))
			$this->routes[] = $route;
	}
	
	/**
	 * Fetch a route
	 *
	 *
	 * @access	public
	 * @param	string	the route url
	 * @return	Route
	 */
	public function getRouteByURL($url)
	{
		if (!empty($url))
		{
			foreach ($this->routes as $route)
			{
				if (($varsValues = $route->match($url)) !== FALSE)
				{
					if ($route->offsetExists('varsNames'))
					{
						$varsNames = explode(',', $route->offsetGet('varsNames'));
						$listVars = array();
						   
						foreach ($varsValues as $key => $match)
						{
							if ($key !== 0)
								$listVars[$varsNames[$key - 1]] = $match;
						}
			
						$route->offsetSet('vars', $listVars);
					}

					return $route;
				}
			}
		}
		
		show_error(ERROR_LEVEL_ERROR, 'Page Not Found', 'The page you try to reach does not exist. ');
	}

	public function getRouteByName($name, $vars = array())
	{
		if (!empty($name))
		{
			foreach ($this->routes as $route)
			{
				if ($route->offsetGet('name') == $name)
				{
					$route->offsetSet('vars', $vars);

					return $route;
				}
			}
		}
		
		show_error(ERROR_LEVEL_ERROR, 'Page Not Found', 'The page you try to reach does not exist. ');
	}
}

?>