<?php  

namespace System\Core;

if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Exceptions Class
 *
 * @subpackage	Core
 * @category	Exceptions
 */
class Exceptions {
	var $action;
	var $severity;
	var $message;
	var $filename;
	var $line;

	/**
	 * Nesting level of the output buffering mechanism
	 *
	 * @var int
	 * @access public
	 */
	var $ob_level;


	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->ob_level = ob_get_level();
	}

	/**
	 * Exception Logger
	 *
	 * This function logs PHP generated error messages
	 *
	 * @access	private
	 * @param	string	the error severity
	 * @param	string	the error string
	 * @param	string	the error filepath
	 * @param	string	the error line number
	 * @return	string
	 */
	function log_exception($severity, $message, $filepath, $line)
	{
		$severity = ( ! isset($this->levels[$severity])) ? $severity : $this->levels[$severity];

		log_message('error', 'Severity: '.$severity.'  --> '.$message. ' '.$filepath.' '.$line, TRUE);
	}
	
	/**
	 * Error
	 *
	 * @access	private
	 * @param	string	the heading
	 * @param	string	the message
	 * @param	string	the template name
	 * @return	string
	 */
	function show_error($heading, $message)
	{		
		$GLOBALS['$_SESSION']->setAttribute('error_title', $heading);
		$GLOBALS['$_SESSION']->setAttribute('error_message', implode('</p><p>', (!is_array($message) ? array($message) : $message)));
		
		$GLOBALS['$_HTTPRESP']->redirect('error');
	}

	/**
	 * Fatal Error
	 *
	 * @access	private
	 * @param	string	the heading
	 * @param	string	the message
	 * @param	string	the template name
	 * @return	string
	 */
	function show_error_fatal($heading, $message, $template = 'error_general')
	{
		$message = implode('</p><p>', (!is_array($message) ? array($message) : $message));

		if (ob_get_level() > $this->ob_level + 1)
		{
			ob_end_flush();
		}
		ob_start();
		include(ERRORSPATH.$template.'.php');
		$buffer = ob_get_contents();
		ob_end_clean();
		return $buffer;
	}

	/**
	 * Native PHP error handler
	 *
	 * @access	private
	 * @param	string	the error severity
	 * @param	string	the error string
	 * @param	string	the error filepath
	 * @param	string	the error line number
	 * @return	string
	 */
	function show_php_error($severity, $message, $filepath, $line)
	{
		$severity = (!isset($this->levels[$severity])) ? $severity : $this->levels[$severity];

		$filepath = str_replace("\\", "/", $filepath);

		// For safety reasons we do not show the full file path
		if (FALSE !== strpos($filepath, '/'))
		{
			$x = explode('/', $filepath);
			$filepath = $x[count($x)-2].'/'.end($x);
		}

		if (ob_get_level() > $this->ob_level + 1)
		{
			ob_end_flush();
		}
		ob_start();
		include(ERRORSPATH.'error_php.php');
		$buffer = ob_get_contents();
		ob_end_clean();
		echo $buffer;
	}
}