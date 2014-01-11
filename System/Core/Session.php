<?php

namespace System\Core;

if (!defined('BASEPATH')) exit('No direct script access allowed');

// Start the session
session_start();
 
class Session
{	
	public function __construct(\System\Core\Config $config, \System\Core\HTTPRequest $request)
	{		
		if (!$this->isAuthenticated())
		{
			if ($request->cookieExists($config->getItem(CFG_GENERAL, 'sess_cookie_name').'id'))
			{
				// Set the session with the cookies values
				$this->setAttribute('id', $request->cookieData('id'));
				$this->setAttribute('username', $request->cookieData('username'));
				$this->setAttribute('email', $request->cookieData('email'));
				$this->setAttribute('rank', $request->cookieData('rank'));
				$this->setAuthenticated(TRUE);
				
				// Renewal the cookies expiration time
				$this->setCookie($config->getItem(CFG_GENERAL, 'sess_cookie_name').'id', $this->getAttribute('id'), $config->getItem(CFG_GENERAL, 'sess_expiration'));
				$this->setCookie($config->getItem(CFG_GENERAL, 'sess_cookie_name').'username', $this->getAttribute('username'), $config->getItem(CFG_GENERAL, 'sess_expiration'));
				$this->setCookie($config->getItem(CFG_GENERAL, 'sess_cookie_name').'email', $this->getAttribute('email'), $config->getItem(CFG_GENERAL, 'sess_expiration'));
				$this->setCookie($config->getItem(CFG_GENERAL, 'sess_cookie_name').'rank', $this->getAttribute('rank'), $config->getItem(CFG_GENERAL, 'sess_expiration'));
			}
			else
			{
				// Set a new session
				$this->setAttribute('id', 0);
				$this->setAttribute('username', NULL);
				$this->setAttribute('email', NULL);
				$this->setAttribute('rank', 0);
				$this->setAuthenticated(FALSE);
			}
		}
	}
	
	public function getAttribute($attr) 
	{
		return isset($_SESSION[$attr]) ? $_SESSION[$attr] : NULL;
	}
	   
	public function getFlash() 
	{
		$flash = $_SESSION['flash'];
		unset($_SESSION['flash']);
		 
		return $flash;
	}
	   
	public function hasFlash()
	{
		return isset($_SESSION['flash']);
	}
	   
	public function isAuthenticated() 
	{
		return isset($_SESSION['auth']) ? $_SESSION['auth'] : FALSE;
	}
	   
	public function setAttribute($attr, $value) 
	{
		$_SESSION[$attr] = $value;
	}
	   
	public function setAuthenticated($authenticated = TRUE)
	{
		if (!is_bool($authenticated))
		{
			show_error(500, 'Invalid Argument', 'The value specified in the method "Session::setAuthenticated()" must be a boolean');
		}
		 
		$_SESSION['auth'] = $authenticated;
	}
	   
	public function setFlash($value) 
	{
		$_SESSION['flash'] = $value;
	}
	
	public function setCookie($name, $value = '', $expire = 0, $path = NULL, $domain = NULL, $secure = FALSE, $httpOnly = TRUE) 
	{
		setcookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
	}
}

?>