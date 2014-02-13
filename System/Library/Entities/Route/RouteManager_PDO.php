<?php

namespace System\Library\Entities\Route;

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
use System\Library\Entities\Route\Route;
 
class RouteManager_PDO extends RouteManager
{
	public function getList() 
	{
		$query = $this->dao('Site')->query('SELECT id, uri, application, module, action, varsNames, security FROM routes');
		$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\System\Library\Entities\Route\Route');
		$routes = $query->fetchAll();

		return $routes;
	}
}

?>