<?php

namespace System\Core;

if (!defined('BASEPATH')) exit('No direct script access allowed');

use \System\Core\Config;
use \System\Library\Page;

class HTTPResponse
{	
	public function addHeader($header) 
	{
		header($header);
	}
 
	public function redirect($location) 
	{
		$config = new Config();

		header('Location: '.$config->getItem(CFG_GENERAL, 'base_url').$location);
		exit;
	}
	
	public function sendGeneratedPage(Page $page) 
	{
		exit($page->getGeneratedPage());
	}

	public function setCookie($name, $value = '', $expire = 0, $path = NULL, $domain = NULL, $secure = FALSE, $httpOnly = TRUE) 
	{
		setcookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
	}
}

?>