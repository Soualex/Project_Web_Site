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
		
		if (!empty($author_id) && is_numeric($author_id))
		{
			$this->author = $DB->getManager('Account', 'Site')->getId($author_id);
		}
	}
	   
	public function setTitle($title)
	{
		if (!empty($title) && is_string($title))
		{
			$this->title = $title;
		}
	}
	   
	public function setContent($content)
	{
		if (!empty($content) && is_string($content))
		{
			$this->content = $content;
		}
	}
	   
	public function setAdd_date($add_date)
	{
		if (!empty($add_date))
		{
			$this->add_date = new \DateTime($add_date);
		}
	}
	   
	public function setUpdate_date($update_add)
	{
		if (!empty($update_add))
		{
			$this->update_add = new \DateTime($update_add);
		}
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