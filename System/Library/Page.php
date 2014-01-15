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
		
		foreach ($this->views as $name => $view)
		{		
			ob_start();
				require_once($view);
			${$name} = ob_get_clean();
		}
		 
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
	   
	public function addView($name, $view) 
	{
		if (empty($view) || empty($name) || !file_exists($view))
		{
			show_error(ERROR_LEVEL_FATAL, 'Invalid View', 'The view specified in "Page::addView()" is invalid.');
		}
 
		$this->views[$name] = $view;
	}
	
	public function setTemplate($tpl_path) 
	{
		if (empty($tpl_path) || !file_exists($tpl_path))
		{
			show_error(ERROR_LEVEL_FATAL, 'Invalid Template', 'The template specified in "Page::setTemplate()" is invalid.');
		}
 
		$this->template = $tpl_path;
	}
}

?>