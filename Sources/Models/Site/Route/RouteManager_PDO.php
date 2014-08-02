<?php

namespace System\Library\Models\Route;

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
use System\Library\Models\Route\Route;
 
class RouteManager_PDO extends RouteManager
{
	public function getList() 
	{
		$query = $this->dao('Site')->query('SELECT uri, application, module, action, varsNames, security FROM routes');
		$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\System\Library\Models\Route\Route');
		$routes = $query->fetchAll();

		return $routes;
	}
}

?>