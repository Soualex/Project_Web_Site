<?php

namespace System\Library\Database\Site\News;

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class News extends \System\Library\Entity
{
	protected $title,
			  $author,
			  $content,
			  $add_date,
			  $update_date;
	   
	public function isValid()
	{
		return !(empty($this->author) || empty($this->title) || empty($this->content));
	}
	   
	   
	// SETTERS //
	   
	public function setAuthor($author_id)
	{
		global $DB;
		
		if (!empty($author_id) && is_int($author_id) && $author_id > 0)
		{
			$accountManager = new \System\Library\Models\AccountManager_PDO($DB->getInstanceOf('site'));
			$this->author = $accountManager->getId($author_id);
		}
		else
			$this->errors['author_id'] = "L'ID de l'utilisateur doit être un nombre entier positif";
	}
	   
	public function setTitle($title)
	{
		if (!is_string($title) || empty($title))
		  	$this->errors[] = "Le titre doit être une chaîne de caratères.";
		else
		  	$this->title = $title;
	}
	   
	public function setContent($content)
	{
		if (!is_string($content) || empty($content))
		 	$this->erreurs[] = "Le contenu de la news doit être une chaîne de caratères.";
		else
			$this->content = $content;
	}
	   
	public function setAdd_date(\DateTime $add_date)
	{
		$this->add_date = $add_date;
	}
	   
	public function setUpdate_date(\DateTime $update_add)
	{
		$this->update_add = $update_add;
	}
	   
	// GETTERS //
	   
	public function title()
	{
		return $this->title;
	}
	
	public function author()
	{
		return $this->author;
	}
	   
	public function content()
	{
		return $this->content;
	}
	   
	public function add_date()
	{
		return $this->add_date;
	}
	   
	public function update_date()
	{
		return $this->update_date;
	}
}

?>