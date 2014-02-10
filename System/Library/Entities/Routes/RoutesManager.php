<?php

namespace System\Library\Database\Site\Routes;

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
abstract class RoutesManager extends \System\Library\Manager
{
	/**
	 * Méthode retournant une page précise
	 * @param $name string Le nom de la page demandée
	 * @return Page La page demandée
	 */
	abstract public function getList();	
}

?>