<?php

namespace Applications\Frontend\Modules\Pages;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class PagesController extends \System\Library\BackController
{
	public function executeIndex(\System\Core\HTTPRequest $request)
	{
		$this->app()->page()->addVar('title', 'Pages Personnalisées');
		
		$pages = $this->app()->db_handler()->getManager('Pages', 'Site')->getList();
		
		$this->app()->page()->addVar('custom_pages', $pages);
	}
	
	public function executeShow(\System\Core\HTTPRequest $request)
	{
		$page = $this->app()->db_handler()->getManager('Pages', 'Site')->get($request->getData('page_name'));

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