<?php

namespace Applications\Backend\Modules\Pages;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class PagesController extends \System\Library\BackController
{
	public function executeIndex(\System\Core\HTTPRequest $request)
	{
		$this->app()->page()->addVar('page_name', 'Gestion des pages');
		
		$pages = $this->app()->entities_handler()->load_model_manager('Pages')->getList();
		
		$custom_pages = array();
		foreach ($pages as $page)
		{
			if ($page->offsetGet('security') <= $this->app()->session()->getAttribute('rank'))
			{
				$custom_pages[] = $page;
			}
		}
		
		$this->app()->page()->addVar('custom_pages', $custom_pages);
	}
	
	public function executeAdd(\System\Core\HTTPRequest $request)
	{
		$this->app()->page()->addVar('page_name', 'Ajouter une page');
		
		if ($request->postExists('page_url') && $request->postExists('page_name') && $request->postExists('page_content') && $request->postExists('page_security'))
		{
			$page = $this->app()->entities_handler()->load_model('Pages', 'Page', array('url' => $request->postData('page_url'),
																					   'name' => $request->postData('page_name'),
																					   'content' => $request->postData('page_content'),
																					   'security' => $request->postData('page_security')));
																			   
			$this->app()->entities_handler()->load_model_manager('Pages')->add($page);
		}
	}
	
	public function executeDelete(\System\Core\HTTPRequest $request)
	{
		$this->app()->page()->addVar('page_name', 'Supprimer une page');
		
		if (($page = $this->app()->entities_handler()->load_model_manager('Pages')->get($request->getData('page_url'))) != NULL)
		{
			$this->app()->entities_handler()->load_model_manager('Pages')->delete($request->getData('page_url'));
			$this->app()->page()->addVar('module_message', 'La page [b]"'.$page->offsetGet('name').'"[/b] a été correctement supprimé de la base de données.');
		}
		else
		{
			show_error(ERROR_LEVEL_ERROR, 'Deletion Interrompue', 'La page que vous tentez de supprimer est inexistante dans la base de données.');
		}
	}
}
?>