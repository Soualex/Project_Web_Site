<?php

namespace Applications\Frontend\Modules\News;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class NewsController extends \System\Library\BackController
{
	public function executeIndex(\System\Core\HTTPRequest $request)
	{
		$nombreNews = $this->app()->config()->getItem(CFG_APP, 'nombre_news');

		$this->app()->page()->addVar('page_name', 'Actualités');

		$manager = $this->app()->db_handler()->getManager('News', 'Site');

		$listNews = $manager->getList();

		$this->app()->page()->addVar('listNews', $listNews);
	}
}

?>