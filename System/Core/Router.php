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
	
	public function __construct(\System\Core\Config $CFG, \System\Library\Database\Database_Handler $DB)
	{
		$this->CFG = $CFG;
		$this->DB = $DB;
		
		// Get the routes class from database
		$routes = $DB->getManager('Routes', 'Site')->getList();
		
		foreach ($routes as $route)
		{
			// Add a new Route class to the Router class
			$this->addRoute($route);
		}
	}
	
	/**
	 * Add a route in the routes list
	 *
	 *
	 * @access	public
	 * @param	Route	the route to add
	 */
	public function addRoute(\System\Library\Database\Site\Routes\Routes $route)
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
						$varsNames = $route->offsetGet('varsNames');
						$listVars = array();
						   
						foreach ($varsValues as $key => $match)
						{
							if ($key !== 0)
							{
								$listVars[$varsNames[$key - 1]] = $match;
							}
						}
			
						$route->offsetSet('vars', $listVars);
					}
					 
					return $route;
				}
			}
		}
		
		show_error(ERROR_LEVEL_ERROR, 'Page Not Found', 'The page you try to reach does not exist. ');
	}
}

?>