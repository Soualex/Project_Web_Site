<?php

/*
 *---------------------------------------------------------------
 * APPLICATION ENVIRONMENT
 *---------------------------------------------------------------
 *
 * You can load different configurations depending on your
 * current environment. Setting the environment also influences
 * things like logging and error reporting.
 *
 * This can be set to anything, but default usage is:
 *
 *     development
 *     testing
 *     production
 *
 * NOTE: If you change these, also change the error_reporting() code below
 *
 */

	define('ENVIRONMENT', 'development');
/*
 *---------------------------------------------------------------
 * ERROR REPORTING
 *---------------------------------------------------------------
 *
 * Different environments will require different levels of error reporting.
 * By default development will show errors but testing and live will hide them.
 */

if (defined('ENVIRONMENT'))
{
	switch (ENVIRONMENT)
	{
		case 'development':
			error_reporting(E_ALL & ~E_DEPRECATED);
			ini_set('display_errors', '1');
		break;
	
		case 'testing':
		case 'production':
			error_reporting(0);
		break;

		default:
			exit('The application environment is not set correctly.');
	}
}

if(!ini_get('date.timezone'))
{
	date_default_timezone_set("Europe/Paris");
}

/*
 *---------------------------------------------------------------
 * FOLDER NAME
 *---------------------------------------------------------------
 *
 * This variables must contain the name of the folder corresponding.
 * Include the path if the folder is not in the same  directory
 * as this file.
 *
 */
	$system_path = 'System';
	$applications_folder = 'Applications';
	$errors_folder = 'Errors';
	$uploads_folder = 'Uploads';
	

// --------------------------------------------------------------------
// END OF USER CONFIGURABLE SETTINGS.  DO NOT EDIT BELOW THIS LINE
// --------------------------------------------------------------------

/*
 * ---------------------------------------------------------------
 *  Resolve the system path for increased reliability
 * ---------------------------------------------------------------
 */

	// Set the current directory correctly for CLI requests
	if (defined('STDIN'))
	{
		chdir(dirname(__FILE__));
	}

	if (realpath($system_path) !== FALSE)
	{
		$system_path = realpath($system_path).'/';
	}

	// ensure there's a trailing slash
	$system_path = rtrim($system_path, '/').'/';

	// Is the system path correct?
	if (!is_dir($system_path))
	{
		exit("Your system folder path does not appear to be set correctly. Please open the following file and correct this: ".pathinfo(__FILE__, PATHINFO_BASENAME));
	}

/*
 * -------------------------------------------------------------------
 *  Now that we know the path, set the main path constants
 * -------------------------------------------------------------------
 */
	// The name of THIS file
	define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
	
	// The home directory
	define('HOMEPATH', dirname(__FILE__));

	// The PHP file extension
	// this global constant is deprecated.
	define('EXT', '.php');

	// Path to the system folder
	define('BASEPATH', str_replace("\\", "/", $system_path));

	// Path to the front controller (this file)
	define('FCPATH', str_replace(SELF, '', __FILE__));

	// Name of the "system folder"
	define('SYSDIR', trim(strrchr(trim(BASEPATH, '/'), '/'), '/'));

	// Define APPPATH
	if (is_dir($applications_folder))
	{
		define('APPPATH', realpath(rtrim($applications_folder)).'\\');
	}
	else
	{
		exit("Your applications folder path does not appear to be set correctly. Please open the following file and correct this: ".SELF);
	}
	
	// Define UPLPATH
	if (is_dir($uploads_folder))
	{
		define('UPLPATH', realpath(rtrim($uploads_folder)).'\\');
	}
	else
	{
		exit("Your uploads folder path does not appear to be set correctly. Please open the following file and correct this: ".SELF);
	}
	
	// Define ERRORSPATH
	if (is_dir($errors_folder))
	{
		define('ERRORSPATH', realpath(rtrim($errors_folder)).'\\');
	}
	else
	{
		exit("Your errors folder path does not appear to be set correctly. Please open the following file and correct this: ".SELF);
	}

	if(get_magic_quotes_gpc())
	{
	    function stripslashes_gpc(&$value)
	    {
	        $value = stripslashes($value);
	    }
	    
	    array_walk_recursive($_GET, 'stripslashes_gpc');
	    array_walk_recursive($_POST, 'stripslashes_gpc');
	    array_walk_recursive($_COOKIE, 'stripslashes_gpc');
	    array_walk_recursive($_REQUEST, 'stripslashes_gpc');
	}
	
/*
 * --------------------------------------------------------------------
 * LOAD THE BOOTSTRAP FILE
 * --------------------------------------------------------------------
 *
 */
require_once BASEPATH.'Core/Bootstrap.php';