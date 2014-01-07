<?php

namespace System\Library;

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
abstract class ApplicationComponent
{
	protected $_app;
	   
	public function __construct(\System\Core\Application $app) 
	{
		$this->_app = $app;
	}
	   
	public function app() 
	{
		return $this->_app;
	}
}

?>