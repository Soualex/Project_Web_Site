<?php

namespace Applications\Frontend\Modules\Page;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class PageController extends \System\Library\BackController
{
	public function executeShow(\System\Core\HTTPRequest $request)
	{
		$page = $this->app()->db_handler()->getManagerOf('Page')->get($request->getData('page_name'));

		if (!empty($page))
		{
			$this->app()->page()->addVar('title', $page->offsetGet('title'));
			
			$this->app()->page()->addVar('page', $page);
		}
		else
		{
			show_error(500, '987', '5441df');
		}
	}
}

?>