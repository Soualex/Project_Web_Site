<?php

namespace System\Library\Entities\Pages;

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
use \System\Library\Entities\Pages\Page;
 
class PagesManager_PDO extends PagesManager
{
	public function getList() 
	{
		$query = $this->dao('Site')->query('SELECT id, url, name, content, security FROM pages');

		$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\System\Library\Entities\Pages\Page');
		
		$pages = $query->fetchAll();

		return $pages;
	}
	
	public function get($url) 
	{
		$query = $this->dao('Site')->prepare('SELECT id, url, name, content, security FROM pages WHERE name = :url');
		$query->bindValue(':url', $url, \PDO::PARAM_STR);
		$query->execute();

		$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\System\Library\Entities\Pages\Page');
		
		$page = $query->fetch();

		return $page;
	}
}

?>