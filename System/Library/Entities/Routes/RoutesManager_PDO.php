<?php

namespace System\Library\Database\Site\Routes;

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
use \System\Library\Database\Site\Routes\Routes;
 
class RoutesManager_PDO extends RoutesManager
{
	public function getList() 
	{
		$query = $this->dao->query('SELECT id, uri, application, module, action, varsNames, security FROM routes');
		$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\System\Library\Database\Site\Routes\Routes');
		$routes = $query->fetchAll();

		return $routes;
	}
}

?>