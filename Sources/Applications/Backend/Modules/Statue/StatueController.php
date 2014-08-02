<?php

namespace Applications\Backend\Modules\Statue;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class StatueController extends \System\Library\BackController
{
	public function executeIndex(\System\Core\HTTPRequest $request)
	{
		$this->app()->page()->addVar('page_name', 'Administartion');
	}
}

?>