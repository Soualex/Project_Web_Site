<?php

namespace Applications\Frontend\Modules\News;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class NewsController extends \System\Library\BackController
{
	public function executeIndex(\System\Core\HTTPRequest $request)
	{
		$this->app()->page()->addVar('page_name', 'Actualités');
		
		$listNews = $this->app()->db_handler()->getManager('News', 'Site')->getList();

		$nombreDePages = ceil(count($listNews) / $this->app()->config()->getItem(CFG_APP, 'articles_per_page'));

		if($request->getExists('page'))
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
		
		$listNews = $this->app()->db_handler()->getManager('News', 'Site')->getList($premiereEntree, $this->app()->config()->getItem(CFG_APP, 'articles_per_page'));

		$this->app()->page()->addVar('listNews', $listNews);
	}
}

?>