<?php

namespace Applications\Frontend\Modules\Pages;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class PagesController extends \System\Library\BackController
{
	public function executeIndex(\System\Core\HTTPRequest $request)
	{
		$this->app()->page()->addVar('title', 'Pages Personnalisées');
		
		$pages = $GLOBALS['$_MODELS_HANDLER']->load_model_manager('Pages')->getList();
		
		$custom_pages = array();
		foreach ($pages as $page)
		{
			if ($page->offsetGet('security') <= $GLOBALS['$_SESSION']->getAttribute('rank'))
			{
				$custom_pages[] = $page;
			}
		}
		
		$this->app()->page()->addVar('custom_pages', $custom_pages);
	}
	
	public function executeShow(\System\Core\HTTPRequest $request)
	{
		$page = $GLOBALS['$_MODELS_HANDLER']->load_model_manager('Pages')->get($request->getData('page_url'));

		if (!empty($page) && $page->offsetGet('security') <= $GLOBALS['$_SESSION']->getAttribute('rank'))
		{
			$this->app()->page()->addVar('title', $page->offsetGet('name'));
			$this->app()->page()->addVar('custom_page', $page);
		}
		else
		{
			show_error(ERROR_LEVEL_ERROR, 'Page Inexistante', 'La page personnalisée à laquelle vous tentez d\'accéder n\'est pas présente dans notre base de données.');
		}
	}
}

?>