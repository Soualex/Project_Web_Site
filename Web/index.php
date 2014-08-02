<?php

require_once('../System/Config/Constants.php');

if(!ini_get('date.timezone'))
{
	date_default_timezone_set("Europe/Paris");
}

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

	function autoload($class)
	{
	  require BASE_PATH.'/'.str_replace('\\', '/', $class).'.php';
	}

	spl_autoload_register('autoload');
	
/*
 * --------------------------------------------------------------------
 * LOAD THE KERNEL
 * --------------------------------------------------------------------
 *
 */
	$kernel = new System\Core\Kernel();
	$kenerl->start();