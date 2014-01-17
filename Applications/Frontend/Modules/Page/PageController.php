<?php

namespace Applications\Frontend\Modules\Page;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class PageController extends \System\Library\BackController
{
	public function executeIndex(\System\Core\HTTPRequest $request)
	{
		$this->app()->page()->addVar('title', 'Pages Personnalisées');
		
		$page = $this->app()->db_handler()->getManager('Page', 'Site')->getList();
		
		$this->app()->page()->addVar('custom_pages', $pages);
	}
	
	public function executeShow(\System\Core\HTTPRequest $request)
	{
		$page = $this->app()->db_handler()->getManager('Page', 'Site')->get($request->getData('page_name'));

		if (!empty($page))
		{
			$this->app()->page()->addVar('title', $page->offsetGet('title'));
			
			$this->app()->page()->addVar('custom_page', $page);
		}
		else
		{
			show_error(500, 'Page Inexistante', '5441df');
		}
	}
}

?>