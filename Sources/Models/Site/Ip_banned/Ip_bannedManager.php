<?php

namespace System\Library\Models\Ip_banned;

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
abstract class Ip_bannedManager extends \System\Library\Manager
{
	/**
	 * Méthode retournant une page précise
	 * @param $name string Le nom de la page demandée
	 * @return Page La page demandée
	 */
	abstract public function get($ip);	
}

?>