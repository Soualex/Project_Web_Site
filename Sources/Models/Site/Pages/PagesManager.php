<?php

/*
	CLASS: PagesManager
	PATH: System\Library\Models\Pages
	DESCRIPTION: Models for the pages managers' classes.
	LAST UPDATE: 03/05/2014
	AUTHORS: Soulalex
*/

namespace System\Library\Models\Pages;

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
abstract class PagesManager extends \System\Library\Manager
{
	/**
	 * Méthode retournant une page précise
	 * @param $name string Le nom de la page demandée
	 * @return Page La page demandée
	 */
	abstract public function getList();	
	
	/**
	 * Méthode retournant une page précise
	 * @param $name string Le nom de la page demandée
	 * @return Page La page demandée
	 */
	abstract public function get($name);
	
	abstract public function add(\System\Library\Models\Pages\Page $page);
	
	abstract public function delete($page_url);
}

?>