<?php

namespace System\Library\Database\Site\Files;

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
use \System\Library\Database\Site\Files\Files;
 
class FilesManager_PDO extends FilesManager
{
	public function getList($debut = -1, $limite = -1) 
	{
		$sql = "SELECT * FROM files ORDER BY upload_date DESC";

		if ($debut != -1 || $limite != -1) {
			$sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
		}

		$query = $this->dao->query($sql);
		$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\System\Library\Database\Site\Files\Files');

		$listeNews = $query->fetchAll();
 
		$query->closeCursor();

		return $listeNews;
	}
	
	public function getId($id) 
	{
		$query = $this->dao->prepare('SELECT * FROM files WHERE id = :id');
		$query->bindValue(':id', $id, \PDO::PARAM_INT);
		$query->execute();

		$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\System\Library\Database\Site\Files\Files');
		$file = $query->fetch();
		$query->closeCursor();

		return $file;
	}

	public function add(\System\Library\Database\Site\Files\Files $file) 
	{		
		$query = $this->dao->prepare('INSERT INTO files(uploader, filename, file_size, upload_date) 
												  VALUES(:uploader, :filename, :file_size, NOW())');
												  
		$query->bindValue(':uploader', (int) $file->offsetGet('uploader'), \PDO::PARAM_INT);
		$query->bindValue(':filename', $file->offsetGet('filename'), \PDO::PARAM_STR);
		$query->bindValue(':file_size', $file->offsetGet('file_size'), \PDO::PARAM_INT);
		
		$query->execute();
		
		$query->closeCursor();
	}
}

?>
