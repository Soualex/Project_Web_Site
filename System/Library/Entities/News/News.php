<?php

namespace System\Library\Entities\News;

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

	public function setAuthor($author)
	{		
		if (!empty($author_id) && is_string($author))
		{
			$this->author = $author;
		}
	}

	public function setTitle($title)
	{
		if (is_string($title) || !empty($title))
		{
		  	$this->title = $title;
		}
	}

	public function setContent($content)
	{
		if (is_string($content) || !empty($content))
		{
		 	$this->content = $content;
		}
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