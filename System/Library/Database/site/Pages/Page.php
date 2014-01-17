<?php

namespace System\Library\Database\Site\Pages;

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Page extends \System\Library\Entity
{
	protected $url;
	protected $name;
	protected $content;
	protected $security;
	
	
	// SETTERS
	
	public function setUrl($name)
	{
		if (!empty($name) && is_string($name))
			$this->name = $name;
	}
	
	public function setName($title)
	{
		if (!empty($title) && is_string($title))
			$this->title = $title;
	}
	
	public function setContent($content)
	{
		if (!empty($content) && is_string($content))
			$this->title = $content;
	}
	
	public function setSecurity($security)
	{
		$this->security = (int) $security;
	}
	
	
	// GETTERS
	
	public function url()
	{
		return $this->name;
	}
	
	public function name()
	{
		return $this->title;
	}
	
	public function content()
	{
		return $this->content;
	}
	
	public function security()
	{
		return $this->security;
	}
	
}

?>