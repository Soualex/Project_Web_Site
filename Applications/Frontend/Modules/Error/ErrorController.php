<?php

namespace Applications\Frontend\Modules\Error;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class ErrorController extends \System\Library\BackController
{
	public function executeShow(\System\Core\HTTPRequest $request)
	{
		$this->app()->page()->addVar('error_title', $this->app()->session()->getAttribute('error_title'));
		$this->app()->page()->addVar('error_message', $this->app()->session()->getAttribute('error_message'));
	}
}

?>