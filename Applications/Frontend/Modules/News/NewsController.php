<?php

namespace Applications\Frontend\Modules\News;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class NewsController extends \System\Library\BackController
{
	public function executeIndex(\System\Core\HTTPRequest $request)
	{
		$this->app()->page()->addVar('page_name', 'Actualités');

		$nombreDePages = ceil($this->app()->entities_handler()->load_model_manager('News')->countNews() / $this->app()->config()->getItem(CFG_APP, 'articles_per_page'));

		if($request->getExists('page') && $request->getData('page') > 0)
		{
			$pageActuelle = intval($request->getData('page'));
			 
			if($pageActuelle > $nombreDePages)
			{
				$pageActuelle = $nombreDePages;
			}
		}
		else
		{
			$pageActuelle = 1;
		}

		$premiereEntree = ($pageActuelle - 1) * $this->app()->config()->getItem(CFG_APP, 'articles_per_page');
		
		$listNews = $this->app()->entities_handler()->load_model_manager('News')->getList($premiereEntree, $this->app()->config()->getItem(CFG_APP, 'articles_per_page'));
	
		$this->app()->page()->addVar('nombreDePages', $nombreDePages);
		$this->app()->page()->addVar('pageActuelle', $pageActuelle);
		$this->app()->page()->addVar('listNews', $listNews);
	}
}

?>