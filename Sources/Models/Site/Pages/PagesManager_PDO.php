<?php

/*
	CLASS: PagesManager_PDO
	PATH: System\Library\Models\Pages
	DESCRIPTION: Script allowing to control the table "pages" from the database with the driver "PDO".
	LAST UPDATE: 03/05/2014
	AUTHORS: Soulalex
*/

namespace System\Library\Models\Pages;

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
use \System\Library\Models\Pages\Page;
 
class PagesManager_PDO extends PagesManager
{
	public function getList() 
	{
		$query = $this->dao('Site')->query('SELECT url, name, content, security FROM pages');
		$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\System\Library\Models\Pages\Page');
		$pages = $query->fetchAll();
		$query->closeCursor();

		return $pages;
	}
	
	public function get($url) 
	{
		$query = $this->dao('Site')->prepare('SELECT url, name, content, security FROM pages WHERE url = :url');
		$query->bindValue(':url', $url, \PDO::PARAM_STR);
		$query->execute();
		$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\System\Library\Models\Pages\Page');
		$page = $query->fetch();
		$query->closeCursor();

		return $page;
	}
	
	public function add(\System\Library\Models\Pages\Page $page)
	{
		$query = $this->dao('Site')->prepare('INSERT INTO pages(url, name, content, security) VALUES(:url, :name, :content, :security)');
		$query->bindValue(':url', $page->offsetGet('url'), \PDO::PARAM_STR);
		$query->bindValue(':name', $page->offsetGet('name'), \PDO::PARAM_STR);
		$query->bindValue(':content', $page->offsetGet('content'), \PDO::PARAM_STR);
		$query->bindValue(':security', $page->offsetGet('security'), \PDO::PARAM_STR);
		$query->execute();
		$query->closeCursor();
	}
	
	public function delete($page_url)
	{
		$query = $this->dao('Site')->prepare('DELETE FROM pages WHERE url = :page_url');
		$query->bindValue(':page_url', $page_url, \PDO::PARAM_STR);
		$query->execute();
		$query->closeCursor();
	}
}

?>