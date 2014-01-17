<?php

namespace Applications\Frontend\Modules\Error;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class ErrorController extends \System\Library\BackController
{
	public function executeShow(\System\Core\HTTPRequest $request)
	{
		if ($this->app()->session()->hasAttribute('error_title') && $this->app()->session()->hasAttribute('error_message'))
		{
			$this->app()->page()->addVar('error_title', $this->app()->session()->getAttribute('error_title'));
			$this->app()->session()->unsetAttribute('error_title');
			
			$this->app()->page()->addVar('error_message', $this->app()->session()->getAttribute('error_message'));
			$this->app()->session()->unsetAttribute('error_title');
		}
		else
		{
			$this->app()->page()->addVar('error_title', 'No Error Caught');

			$this->app()->page()->addVar('error_message', 'Aucune erreur n\'a été détectée par le gestionnaire d\'erreur. Si toute fois vous pensez rencontrer un problème technique veulliez <a href="mailto:soualexduseptsix@gmail.com" >contacter le webmaster</a>.');
		}
	}
}

?>