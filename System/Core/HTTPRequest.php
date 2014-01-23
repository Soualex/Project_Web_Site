<?php

namespace System\Core;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class HTTPRequest 
{
	public function cookieData($key) 
	{
		return isset($_COOKIE[$key]) ? $_COOKIE[$key] : NULL;
	}
	
	public function cookieExists($key) 
	{
		return isset($_COOKIE[$key]);
	}
	   
	public function getData($key) 
	{
		return isset($_GET[$key]) ? $_GET[$key] : NULL;
	}
 
	public function getExists($key) 
	{
		return isset($_GET[$key]);
	}

	public function method() 
	{
		return $_SERVER['REQUEST_METHOD'];
	}

	public function postData($key) 
	{
		return isset($_POST[$key]) ? $_POST[$key] : NULL;
	}

	public function postExists($key) 
	{
		return isset($_POST[$key]);
	}
	
	public function filesData($key, $attr) 
	{
		return isset($_FILES[$key][$attr]) ? $_FILES[$key][$attr] : NULL;
	}

	public function filesExists($key) 
	{
		return isset($_FILES[$key]);
	}

	public function getURL() 
	{
		if (isset($_SERVER['HTTP_HOST']))
		{
			$base_url = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
			$base_url .= '://'.$_SERVER['HTTP_HOST'];
			$base_url .= $_SERVER['REQUEST_URI'];
			
			return $base_url;
		}
		
		return 'http://localhost'.$_SERVER['REQUEST_URI'];
	}
	
	public function getUserIP()
	{
		return (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
	}
}

?>