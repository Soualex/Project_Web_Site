<?php

namespace System\Library\Models;

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
use \Library\Entities\Page;
 
class PagesManager_PDO extends PagesManager
{
	public function get($name) 
	{
		$query = $this->dao->prepare('SELECT id, title, content, name, security FROM custom_pages WHERE name = :name');
		$query->bindValue(':name', secureDB($name), \PDO::PARAM_STR);
		$query->execute();

		$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\System\Library\Entities\Page');
		
		$page = $query->fetch();

		return $page;
	}
}

?>