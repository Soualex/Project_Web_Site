<?php

namespace System\Core;

if (!defined('BASEPATH')) exit('No direct script access allowed');

session_start();

class Session
{	
	public function __construct()
	{		
		if (!$this->isAuthenticated())
		{
			if ($GLOBALS['$_HTTPRQST']->cookieExists($GLOBALS['$_CFG']->getItem(CFG_GENERAL, 'sess_cookie_name').'id'))
			{
				// Set the session with the cookies values
				$this->setAttribute('id', $GLOBALS['$_HTTPRQST']->cookieData('id'));
				$this->setAttribute('username', $GLOBALS['$_HTTPRQST']->cookieData('username'));
				$this->setAttribute('email', $GLOBALS['$_HTTPRQST']->cookieData('email'));
				$this->setAttribute('rank', $GLOBALS['$_HTTPRQST']->cookieData('rank'));
				$this->setAuthenticated(TRUE);
				
				// Renewal the cookies expiration time
				$this->setCookie($GLOBALS['$_CFG']->getItem(CFG_GENERAL, 'sess_cookie_name').'id', $this->getAttribute('id'), $GLOBALS['$_CFG']->getItem(CFG_GENERAL, 'sess_expiration'));
				$this->setCookie($GLOBALS['$_CFG']->getItem(CFG_GENERAL, 'sess_cookie_name').'username', $this->getAttribute('username'), $GLOBALS['$_CFG']->getItem(CFG_GENERAL, 'sess_expiration'));
				$this->setCookie($GLOBALS['$_CFG']->getItem(CFG_GENERAL, 'sess_cookie_name').'email', $this->getAttribute('email'), $GLOBALS['$_CFG']->getItem(CFG_GENERAL, 'sess_expiration'));
				$this->setCookie($GLOBALS['$_CFG']->getItem(CFG_GENERAL, 'sess_cookie_name').'rank', $this->getAttribute('rank'), $GLOBALS['$_CFG']->getItem(CFG_GENERAL, 'sess_expiration'));
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
	
	public function hasAttribute($attr)
	{
		return isset($_SESSION[$attr]);
	}
	   
	public function isAuthenticated() 
	{
		return isset($_SESSION['auth']) && !empty($_SESSION['auth']) ? $_SESSION['auth'] : FALSE;
	}
	   
	public function setAttribute($attr, $value) 
	{
		$_SESSION[$attr] = $value;
	}
	   
	public function setAuthenticated($authenticated = TRUE)
	{
		if (!is_bool($authenticated))
		{
			show_error(ERROR_LEVEL_FATAL, 'Invalid Argument', 'The value specified in the method "Session::setAuthenticated()" must be a boolean');
		}
		 
		$_SESSION['auth'] = $authenticated;
	}
	   
	public function setFlash($value) 
	{
		$_SESSION['flash'] = $value;
	}
	
	public function unsetAttribute($attr)
	{
		unset($_SESSION[$attr]);
	}
	
	public function setCookie($name, $value = '', $expire = 0, $path = NULL, $domain = NULL, $secure = FALSE, $httpOnly = TRUE) 
	{
		setcookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
	}
}

?>