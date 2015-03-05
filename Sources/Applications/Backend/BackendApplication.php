<?php

/*
	CLASS: FrontendApplication
	PATH: Applications\Backend
	DESCRIPTION: Script allowing to control the Backend application.
	LAST UPDATE: 04/07/2014
	AUTHORS: Soulalex
*/

namespace Applications\Backend;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class BackendApplication extends \System\Library\Application
{
	public function __construct(\System\Library\Models\Route\Route $route)
	{
		parent::__construct($route);
	}
  
	protected function additionalSecurity()
	{
		if($GLOBALS['$_SESSION']->getAttribute('admin_auth') == FALSE && $this->route->uri() != $GLOBALS['$_CFG']->getItem(CFG_GENERAL, 'admin_auth_uri'))
		{
			$GLOBALS['$_HTTPRESP']->redirect($GLOBALS['$_CFG']->getItem(CFG_GENERAL, 'admin_auth_uri'));
		}
	}
}

?>