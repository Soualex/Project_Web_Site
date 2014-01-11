<?php

namespace System\Library\Entities;

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Pages extends \System\Library\Entity
{
	protected $title;
	protected $content;
	protected $name;
	protected $security;
	
	
	// SETTERS
	
	public function setTitle($title)
	{
		if (!empty($title) && is_string($title))
			$this->title = $title;
	}
	
	public function setContent($content)
	{
		if (!empty($content) && is_string($content))
			$this->title = $content;
	}
	
	public function setName($name)
	{
		if (!empty($name) && is_string($name))
			$this->name = $name;
	}
	
	public function setSecurity($security)
	{
		$this->security = (int) $security;
	}
	
	
	// GETTERS
	
	public function title()
	{
		return $this->title;
	}
	
	public function content()
	{
		return $this->content;
	}
	
	public function name()
	{
		return $this->name;
	}
	
	public function security()
	{
		return $this->security;
	}
	
}

?>