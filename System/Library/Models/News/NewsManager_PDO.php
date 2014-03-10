<?php

namespace System\Library\Models\News;

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
use \System\Library\Models\News\News;
 
class NewsManager_PDO extends NewsManager
{
	public function getList($debut = -1, $limite = -1) 
	{
		$sql = "SELECT N.id, N.title, A.username AS author, N.content, N.add_date, N.update_date FROM news N LEFT OUTER JOIN account A ON N.author_id = A.id ORDER BY id DESC";

		if ($debut != -1 || $limite != -1)
		{
			$sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
		}

		$query = $this->dao('Site')->query($sql);
		$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\System\Library\Models\News\News');

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
		$query = $this->dao('Site')->prepare('SELECT N.id, N.title, A.username AS author, N.content, N.add_date, N.update_date FROM news N LEFT OUTER JOIN account A ON N.author_id = A.id AND N.author_id IS NULL WHERE id = :id');
		$query->bindValue(':id', (int) $id, \PDO::PARAM_INT);
		$query->execute();

		$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\System\Library\Models\News\News');

		if ($news = $query->fetch()) 
		{
			$news->setAdd_date(new \DateTime($news->add_date()));
			$news->setUpdate_date(new \DateTime($news->update_date()));
		   
			return $news;
		}

		return NULL;
	}
	
	public function countNews() 
	{
		$query = $this->dao('Site')->query('SELECT COUNT(*) AS number_of_news FROM news');
		$data = $query->fetch();
		
		return $data['number_of_news'];
	}
}

?>