<?php

/*
	CLASS: Page
	PATH: System\Libaray
	DESCRIPTION: Script allowing to generate the page.
	LAST UPDATE: 03/03/2014
	AUTHORS: Soulalex
*/

namespace System\Library;

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Page
{
	protected $views = array();
	protected $vars = array();
	protected $css_files = array();
	protected $js_files = array();
	protected $style;
	protected $app;
	
	public function __construct($application, $style)
	{
		$this->app = $application;
		$this->style = $style;
	}

	public function getGeneratedPage() 
	{		
		extract($this->vars);
		$views = $this->views;
		$css_files = $this->css_files;
		$js_files = $this->js_files;
		
		ob_start();
			require_once(APPPATH.$this->app.'/Styles/'.$this->style.'/layout.php');
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
 
		$this->views[$view_name] = $view;
	}
	
	public function load_javascript($js_file)
	{
		if (!array_key_exists($js_file, $this->js_files))
		{
			$this->js_files[$js_file] = '<script src="/Project_Web_Site/Applications/'.$this->app.'/Styles/'.$this->style.'/Javascripts/'.$js_file.'.js"></script>';
		}
	}
	
	public function load_css($css_file)
	{
		if (!array_key_exists($css_file, $this->css_files))
		{
			$this->css_files[$css_file] = '<link rel="stylesheet" href="/Project_Web_Site/Applications/'.$this->app.'/Styles/'.$this->style.'/CSS/'.$css_file.'.css" />';
		}
	}
}

?>