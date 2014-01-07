<?php

namespace System\Library\Models;

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
use \System\Library\Entities\News;
 
class NewsManager_PDO extends NewsManager
{
	public function getList($debut = -1, $limite = -1) 
	{
		$sql = "SELECT id, title, author, content, add_date, update_date FROM news ORDER BY id DESC";

		if ($debut != -1 || $limite != -1)
			$sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;

		$query = $this->dao->query($sql);
		$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\System\Library\Entities\News');

		$listNews = $query->fetchAll();
		
		$query->closeCursor();

		foreach ($listNews as $news) 
		{
			$news->setAdd_date(new \DateTime($news->add_date()));
			$news->setUpdate_date(new \DateTime($news->update_date()));
		}

		return $listNews;
	}

	public function get($id) 
	{
		$query = $this->dao->prepare('SELECT id, title, author, content, add_date, update_date FROM news WHERE id = :id');
		$query->bindValue(':id', (int) $id, \PDO::PARAM_INT);
		$query->execute();

		$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\System\Library\Entities\News');

		if ($news = $query->fetch()) 
		{
			$news->setAdd_date(new \DateTime($news->add_date()));
			$news->setUpdate_date(new \DateTime($news->update_date()));
		   
			return $news;
		}

		return NULL;
	}
}

?>