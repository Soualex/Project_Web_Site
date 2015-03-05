<?php

/*
	CLASS: FrontendApplication
	PATH: Applications\Frontend
	DESCRIPTION: Script allowing to control the Frontend application.
	LAST UPDATE: 03/11/2014
	AUTHORS: Soulalex
*/

namespace Applications\Frontend;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class FrontendApplication extends \System\Library\Application
{

	public function __construct(\System\Library\Models\Route\Route $route)
	{
		parent::__construct($route);
	}
  
	protected function additionalSecurity()
	{
	
	}
}

?>