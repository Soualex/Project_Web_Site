<?php

namespace System\Library\Database\Site\Pages;

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
use \System\Library\Database\Site\Pages\Page;
 
class PagesManager_PDO extends PagesManager
{
	public function getList() 
	{
		$query = $this->dao->query('SELECT id, url, name, content, security FROM pages');

		$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\System\Library\Database\Site\Pages\Page');
		
		$pages = $query->fetchAll();

		return $pages;
	}
	
	public function get($url) 
	{
		$query = $this->dao->prepare('SELECT id, url, name, content, security FROM pages WHERE name = :url');
		$query->bindValue(':url', secureDB($url), \PDO::PARAM_STR);
		$query->execute();

		$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\System\Library\Database\Site\Pages\Page');
		
		$page = $query->fetch();

		return $page;
	}
}

?>