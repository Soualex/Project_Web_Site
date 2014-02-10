<?php

namespace System\Library\Database\Site\News;

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
use \System\Library\Database\Site\News\News;
 
class NewsManager_PDO extends NewsManager
{
	public function getList($debut = -1, $limite = -1) 
	{
		$sql = "SELECT * FROM news ORDER BY add_date DESC";

		if ($debut != -1 || $limite != -1)
		{
			$sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
		}

		$query = $this->dao->query($sql);
		$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\System\Library\Database\Site\News\News');

		$listNews = $query->fetchAll();
		
		$query->closeCursor();
		
		foreach ($listNews as $news)
		{
			$news->offsetSet('author', $news->offsetGet('author'));
			$news->offsetSet('add_date', $news->offsetGet('add_date'));
			$news->offsetSet('update_date', $news->offsetGet('update_date'));
		}

		return $listNews;
	}

	public function get($id) 
	{
		$query = $this->dao->prepare('SELECT id, title, author, content, add_date, update_date FROM news WHERE id = :id');
		$query->bindValue(':id', (int) $id, \PDO::PARAM_INT);
		$query->execute();

		$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\System\Library\Database\Site\News\News');
		
		$news = $query->fetch();
		
		$query->closeCursor();

		return $news;
	}
}

?>