<?php

namespace Applications\Frontend\Modules\Error;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class ErrorController extends \System\Library\BackController
{
	public function executeShow(\System\Core\HTTPRequest $request)
	{
		if ($GLOBALS['$_SESSION']->hasAttribute('error_title') && $GLOBALS['$_SESSION']->hasAttribute('error_message'))
		{
			$this->app()->page()->addVar('error_title', $GLOBALS['$_SESSION']->getAttribute('error_title'));
			$GLOBALS['$_SESSION']->unsetAttribute('error_title');
			
			$this->app()->page()->addVar('error_message', $GLOBALS['$_SESSION']->getAttribute('error_message'));
			$GLOBALS['$_SESSION']->unsetAttribute('error_title');
		}
		else
		{
			$this->app()->page()->addVar('error_title', 'No Error Caught');

			$this->app()->page()->addVar('error_message', 'Aucune erreur n\'a été détectée par le gestionnaire d\'erreur. Si toute fois vous pensez rencontrer un problème technique veulliez <a href="mailto:soualexduseptsix@gmail.com" >contacter le webmaster</a>.');
		}
	}
}

?>