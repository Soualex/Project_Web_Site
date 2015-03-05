<?php

/*
	CLASS: PagesManager
	PATH: System\Library\Models\Pages
	DESCRIPTION: Model of a page.
	LAST UPDATE: 03/05/2014
	AUTHORS: Soulalex
*/

namespace System\Library\Models\Pages;

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Page extends \System\Library\Entity
{
	protected $url;
	protected $name;
	protected $content;
	protected $security;
	
	
	// SETTERS
	
	public function setUrl($url)
	{
		if (!empty($url) && is_string($url))
		{
			$this->url = $url;
		}
	}
	
	public function setName($name)
	{
		if (!empty($name) && is_string($name))
		{
			$this->name = $name;
		}
	}
	
	public function setContent($content)
	{
		if (!empty($content) && is_string($content))
		{
			$this->content = $content;
		}
	}
	
	public function setSecurity($security)
	{
		$this->security = (int) $security;
	}
	
	
	// GETTERS
	
	public function url()
	{
		return $this->url;
	}
	
	public function name()
	{
		return $this->name;
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