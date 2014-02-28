<?php

namespace System\Library;

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Page
{
	protected $views = array();
	protected $vars = array();
	protected $template;

	public function getGeneratedPage() 
	{		
		extract($this->vars);
		$views = $this->views;
		 
		ob_start();
			require_once($this->template);
		return ob_get_clean();
	}
	
	public function addVar($var, $value) 
	{
		if (!is_string($var) || is_numeric($var) || empty($var))
		{
			show_error(ERROR_LEVEL_FATAL, 'Invalid Argument', 'The variable name must be a string of characters not empty.');
		}

		$this->vars[$var] = $value;
	}
	   
	public function addView($view_name, $view) 
	{
		if (empty($view_name) || empty($view) || !file_exists($view))
		{
			show_error(ERROR_LEVEL_FATAL, 'Vue invalide', 'La vue spécifiée dans "Page::addView()" est invalide.');
		}
 
		$this->modules[$view_name] = $view;
	}
	
	public function setTemplate($tpl_path) 
	{
		if (empty($tpl_path) || !file_exists($tpl_path))
		{
			show_error(ERROR_LEVEL_FATAL, 'Invalid Template', 'The template specified in "Page::setTemplate()" is invalid.');
		}
 
		$this->template = $tpl_path;
	}
	
	public function load_javascript($js_file)
	{
	
	}
}

?>