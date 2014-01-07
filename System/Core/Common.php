<?php  

if (!defined('BASEPATH')) exit('No direct script access allowed');


/**
* Determines if the current version of PHP is greater then the supplied value
*
* Since there are a few places where we conditionally test for PHP > 5
* we'll set a static variable.
*
* @access	public(
* @param	string
* @return	bool	TRUE if the current version is $version or higher
*/
if (!function_exists('is_php'))
{
	function is_php($version = '5.0.0')
	{
		static $_is_php;
		$version = (string) $version;

		if (!isset($_is_php[$version]))
		{
			$_is_php[$version] = (version_compare(PHP_VERSION, $version) < 0) ? FALSE : TRUE;
		}

		return $_is_php[$version];
	}
}

// ------------------------------------------------------------------------

/**
 * Tests for file writability
 *
 * is_writable() returns TRUE on Windows servers when you really can't write to
 * the file, based on the read-only attribute.  is_writable() is also unreliable
 * on Unix servers if safe_mode is on.
 *
 * @access	private
 * @return	void
 */
if (!function_exists('is_really_writable'))
{
	function is_really_writable($file)
	{
		// If we're on a Unix server with safe_mode off we call is_writable
		if (DIRECTORY_SEPARATOR == '/' AND @ini_get("safe_mode") == FALSE)
		{
			return is_writable($file);
		}

		// For windows servers and safe_mode "on" installations we'll actually
		// write a file then read it.  Bah...
		if (is_dir($file))
		{
			$file = rtrim($file, '/').'/'.md5(mt_rand(1,100).mt_rand(1,100));

			if (($fp = @fopen($file, FOPEN_WRITE_CREATE)) === FALSE)
			{
				return FALSE;
			}

			fclose($fp);
			@chmod($file, DIR_WRITE_MODE);
			@unlink($file);
			return TRUE;
		}
		elseif (!is_file($file) OR ($fp = @fopen($file, FOPEN_WRITE_CREATE)) === FALSE)
		{
			return FALSE;
		}

		fclose($fp);
		return TRUE;
	}
}

// ------------------------------------------------------------------------

/**
* Class registry
*
* This function acts as a singleton.  If the requested class does not
* exist it is instantiated and set to a static variable.  If it has
* previously been instantiated the variable is returned.
*
* @access	public
* @param	string	the class name being requested
* @param	string	the directory where the class should be found
* @param	string	the class name prefix
* @return	object
*/
if (!function_exists('load_class'))
{
	function load_class($class)
	{
		$classFile =  HOMEPATH.'/'.str_replace('\\', '/', $class).'.php';
		
		// Verify that the file of the class exist
		if (file_exists($classFile))
		{
			require_once($classFile);
			
			// Verify that the class exist
			if (!class_exists($class))
			{
				exit('Unable to locate the specified class: '.$class.'.php');
			}
		}
		else
		{
			exit('Unable to locate the specified class: '.$class.'.php');
		}
	}
	
	spl_autoload_register('load_class');
}

// ------------------------------------------------------------------------

/**
* Error Handler
*
* This function lets us invoke the exception class and
* display errors using the standard error template located
* in application/errors/errors.php
* This function will send the error page directly to the
* browser and exit.
*
* @access	public
* @return	void
*/
if (!function_exists('show_error'))
{
	function show_error($level, $heading = 'An Error Was Encountered', $message)
	{
		switch ($level)
		{
			case ERROR_LEVEL_WARN:
				$_error = new System\Core\Exceptions();
				echo $_error->show_error_warn($heading, $message);
				exit(E_WARNING);
			break;
			
			case ERROR_LEVEL_ERROR:
				$_error = new System\Core\Exceptions();
				echo $_error->show_error($heading, $message);
				exit(E_USER_ERROR);
			break;
			
			case ERROR_LEVEL_FATAL
				$_error = new System\Core\Exceptions();
				echo $_error->show_error_fatal($heading, $message);
				exit(E_ERROR);
			break;
		}
	}
}

// ------------------------------------------------------------------------

/**
* Error Logging Interface
*
* We use this as a simple mechanism to access the logging
* class and send messages to be logged.
*
* @access	public
* @return	void
*/
if (!function_exists('log_message'))
{
	function log_message($level = 'error', $message, $php_error = FALSE)
	{
		global $CFG;
		static $_log;

		if ($CFG->getItem(CFG_GENERAL, 'log_threshold') == 0)
		{
			return;
		}

		$_log = new System\Core\Log();
		$_log->write_log($level, $message, $php_error);
	}
}

// ------------------------------------------------------------------------

/**
 * Set HTTP Status Header
 *
 * @access	public
 * @param	int		the status code
 * @param	string
 * @return	void
 */
if (!function_exists('set_status_header'))
{
	function set_status_header($code = 200, $text = '')
	{
		$stati = array(
							200	=> 'OK',
							201	=> 'Created',
							202	=> 'Accepted',
							203	=> 'Non-Authoritative Information',
							204	=> 'No Content',
							205	=> 'Reset Content',
							206	=> 'Partial Content',

							300	=> 'Multiple Choices',
							301	=> 'Moved Permanently',
							302	=> 'Found',
							304	=> 'Not Modified',
							305	=> 'Use Proxy',
							307	=> 'Temporary Redirect',

							400	=> 'Bad Request',
							401	=> 'Unauthorized',
							403	=> 'Forbidden',
							404	=> 'Not Found',
							405	=> 'Method Not Allowed',
							406	=> 'Not Acceptable',
							407	=> 'Proxy Authentication Required',
							408	=> 'Request Timeout',
							409	=> 'Conflict',
							410	=> 'Gone',
							411	=> 'Length Required',
							412	=> 'Precondition Failed',
							413	=> 'Request Entity Too Large',
							414	=> 'Request-URI Too Long',
							415	=> 'Unsupported Media Type',
							416	=> 'Requested Range Not Satisfiable',
							417	=> 'Expectation Failed',

							500	=> 'Internal Server Error',
							501	=> 'Not Implemented',
							502	=> 'Bad Gateway',
							503	=> 'Service Unavailable',
							504	=> 'Gateway Timeout',
							505	=> 'HTTP Version Not Supported'
						);

		if ($code == '' OR ! is_numeric($code))
		{
			show_error(500, 'Status codes must be numeric');
		}

		if (isset($stati[$code]) AND $text == '')
		{
			$text = $stati[$code];
		}

		if ($text == '')
		{
			show_error(500, 'No status text available.  Please check your status code number or supply your own message text.');
		}

		$server_protocol = (isset($_SERVER['SERVER_PROTOCOL'])) ? $_SERVER['SERVER_PROTOCOL'] : FALSE;

		if (substr(php_sapi_name(), 0, 3) == 'cgi')
		{
			header("Status: {$code} {$text}", TRUE);
		}
		elseif ($server_protocol == 'HTTP/1.1' OR $server_protocol == 'HTTP/1.0')
		{
			header($server_protocol." {$code} {$text}", TRUE, $code);
		}
		else
		{
			header("HTTP/1.1 {$code} {$text}", TRUE, $code);
		}
	}
}

// --------------------------------------------------------------------

/**
* Exception Handler
*
* This is the custom exception handler that is declaired at the top
* of Codeigniter.php.  The main reason we use this is to permit
* PHP errors to be logged in our own log files since the user may
* not have access to server logs. Since this function
* effectively intercepts PHP errors, however, we also need
* to display errors based on the current error_reporting level.
* We do that with the use of a PHP error template.
*
* @access	private
* @return	void
*/
if (!function_exists('_exception_handler'))
{
	function _exception_handler($severity, $message, $filepath, $line)
	{
		global $CFG;
		
		 // We don't bother with "strict" notices since they tend to fill up
		 // the log file with excess information that isn't normally very helpful.
		 // For example, if you are running PHP 5 and you use version 4 style
		 // class functions (without prefixes like "public", "private", etc.)
		 // you'll get notices telling you that these have been deprecated.
		if ($severity == E_STRICT)
		{
			return;
		}

		$_error = new System\Core\Exceptions();

		// Should we display the error? We'll get the current error_reporting
		// level and add its bits with the severity bits to find out.
		if (($severity & error_reporting()) == $severity)
		{
			$_error->show_php_error($severity, $message, $filepath, $line);
		}

		// Should we log the error?  No?  We're done...
		if ($CFG->getItem(CFG_GENERAL, 'log_threshold') == 0)
		{
			return;
		}

		// $_error->log_exception($severity, $message, $filepath, $line);
	}
}

// --------------------------------------------------------------------

/**
 * Remove Invisible Characters
 *
 * This prevents sandwiching null characters
 * between ascii characters, like Java\0script.
 *
 * @access	public
 * @param	string
 * @return	string
 */
if (!function_exists('remove_invisible_characters'))
{
	function remove_invisible_characters($str, $url_encoded = TRUE)
	{
		$non_displayables = array();
		
		// every control character except newline (dec 10)
		// carriage return (dec 13), and horizontal tab (dec 09)
		
		if ($url_encoded)
		{
			$non_displayables[] = '/%0[0-8bcef]/';	// url encoded 00-08, 11, 12, 14, 15
			$non_displayables[] = '/%1[0-9a-f]/';	// url encoded 16-31
		}
		
		$non_displayables[] = '/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S';	// 00-08, 11, 12, 14-31, 127

		do
		{
			$str = preg_replace($non_displayables, '', $str, -1, $count);
		}
		while ($count);

		return $str;
	}
}

// ------------------------------------------------------------------------

/**
* Returns HTML escaped variable
*
* @access	public
* @param	mixed
* @return	mixed
*/
if (!function_exists('html_escape'))
{
	function html_escape($var)
	{
		global $CFG;
		
		if (is_array($var))
		{
			return array_map('html_escape', $var);
		}
		else
		{
			return htmlentities($var, ENT_QUOTES, $CFG->getItem(CFG_GENERAL, 'charset'));
		}
	}
}

if (!function_exists('secureDB'))
{
	function secureDB($text)
	{
		if (ctype_digit($text))
		{
			$text = intval($text);
		}  
		else 
		{
			//$text = addcslashes($text, '%_');
			$text = trim($text);
		}
			  
		return $text;
	}
}

if (!function_exists('string_format'))
{
	function string_format($string)
	{
		$string = nl2br(str_replace(array("\\n","\\r"),array("\n",""),$string));
		$string = str_replace("\\","",$string);
		
		// BBCode
		$string = preg_replace('`\[g\](.+)\[/g\]`isU', '<strong>$1</strong>', $string); 
		$string = preg_replace('`\[i\](.+)\[/i\]`isU', '<em>$1</em>', $string);
		$string = preg_replace('`\[s\](.+)\[/s\]`isU', '<u>$1</u>', $string);
		$string = preg_replace('#http://[a-z0-9._/-]+#i', '<a href="$0">$0</a>', $string);
		$string = preg_replace('`\[color=(red|blue|green|yellow|purple|olive)\](.+)\[/color\]`isU','<font color="$1">$2</font>', $string); // Couleur
	}
}

// ------------------------------------------------------------------------

/**
* Returns HTML escaped variable
*
* @access	public
* @return	boolean
*/
if (!function_exists('isBannned'))
{
	function isBannned()
	{
		global $HTTPRQST, $DB;
			
		// Get the routes configuation from database
		$query = $DB->getInstanceOf('site')->prepare('SELECT ip, time FROM banip WHERE ip = :ip');
		$query->bindValue(':ip', $HTTPRQST->getUserIP(), \PDO::PARAM_STR);
		$query->execute();
		$data = $query->fetch();
		$query->closeCursor();
		
		if (!empty($data) && strtotime($data['unbandate']) > time())
		{
			return TRUE;	
		}
		
		return FALSE;
	}
}