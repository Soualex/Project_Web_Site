<?php

namespace System\Core;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class HTTPResponse
{
	private $page;
	
	public function addHeader($header) 
	{
		header($header);
	}
 
	public function redirect($location) 
	{
		global $CFG;
		
		header('Location: '.$GLOBALS['$_CFG']->getItem(CFG_GENERAL, 'base_url').$location);
		exit;
	}
	
	public function send() 
	{
		exit($this->page->getGeneratedPage());
	}

	public function setPage(\System\Library\Page $page) 
	{
		$this->page = $page;
	}

	public function setCookie($name, $value = '', $expire = 0, $path = NULL, $domain = NULL, $secure = FALSE, $httpOnly = TRUE) 
	{
		setcookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
	}
}

?>