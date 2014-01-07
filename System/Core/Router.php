<?php

namespace System\Core;

if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Router Class
 *
 * @subpackage	Core
 * @category	Router
 */
class Router
{
	protected $HTTPRQST;
	protected $CFG;
	protected $DB;
	
	protected $_routes = array();
	
	public function __construct(\System\Core\Config $CFG, \System\Library\DataBase_Handler $DB)
	{
		$this->CFG = $CFG;
		$this->DB = $DB;
		
		// Get the routes configuation from database
		$query = $DB->getManager('route', 'site')->getRoutes();
		$routes = $query->fetchAll();
		$query->closeCursor();
		
		// Create a new Route class
		foreach ($routes as $route)
		{
			// Put the variables in an array
			$vars = array();
			if (!empty($route['vars']))
			{
				$vars = explode(',', $route['vars']);
			}
			
			// Create the Route class
			$routeClass = new \System\Library\Route($route['id'], $route['uri'], $route['application'], $route['module'], $route['action'], $vars, $route['security']);
		 	
			// Add a new Route class to the Router class
			$this->addRoute($routeClass);
		}
	}
	
	/**
	 * Add a route in the routes list
	 *
	 *
	 * @access	public
	 * @param	Route	the route to add
	 */
	public function addRoute(\System\Library\Route $route)
	{
		if (!empty($route) && !in_array($route, $this->_routes))
		{
			$this->_routes[] = $route;
		}
	}
	
	/**
	 * Fetch a route
	 *
	 *
	 * @access	public
	 * @param	string	the route url
	 * @return	Route
	 */
	public function getRoute($url)
	{
		if (!empty($url))
		{
			foreach ($this->_routes as $route)
			{
				if (($varsValues = $route->match($url)) !== FALSE)
				{
					if ($route->hasVarsNames())
					{
						$varsNames = $route->varsNames();
						$listVars = array();
						   
						foreach ($varsValues as $key => $match)
						{
							if ($key !== 0)
							{
								$listVars[$varsNames[$key - 1]] = $match;
							}
						}
			
						$route->setVars($listVars);
					}
					 
					return $route;
				}
			}
		}
		
		show_error(ERROR_LEVEL_ERROR, 'Page Not Found', 'The page you try to reach does not exist. ');
	}
}

?>