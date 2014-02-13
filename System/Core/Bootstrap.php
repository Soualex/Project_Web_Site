<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * ------------------------------------------------------
 *  Define the framework's version
 * ------------------------------------------------------
 */
	define('FW_VERSION', '1.0-dev');

/*
 * ------------------------------------------------------
 *  Load the global functions and the framework constants
 * ------------------------------------------------------
 */
	require_once(BASEPATH.'Core/Common.php');
	
	require_once(BASEPATH.'Config/constants.php');

/*
 * ------------------------------------------------------
 *  Define a custom error handler so we can log PHP errors
 * ------------------------------------------------------
 */
	set_error_handler('_exception_handler');

	if (!is_php('5.4'))
	{
		@ini_set('magic_quotes_runtime', 0); // Kill magic quotes
	}

/*
 * ------------------------------------------------------
 *  Instantiate the config class
 * ------------------------------------------------------
 */
	$CFG = new System\Core\Config();
	
	// Load the Generals Configurations
	$CFG->load_general_config();

	// Do we have any manually set config items in the index.php file?
	if (isset($assign_to_config) && is_array($assign_to_config))
	{
		foreach ($assign_to_config as $key => $value)
		{
			$Config->setConfig(CFG_GENERAL, $key, $value);
		}
	}
	
/*
 * ------------------------------------------------------
 *  Instantiate the HTTPRequest class
 * ------------------------------------------------------
 */
	$HTTPRQST = new System\Core\HTTPRequest();
	
/*
 * ------------------------------------------------------
 *  Instantiate the HTTPRequest class
 * ------------------------------------------------------
 */
	$HTTPRESP = new System\Core\HTTPResponse($CFG);
	
/*
 * ------------------------------------------------------
 *  Instantiate the DataBase class
 * ------------------------------------------------------
 */
	$DB = new System\Library\DatabaseHandler($CFG);
	
/*
 * ------------------------------------------------------
 *  Instantiate the DataBase class
 * ------------------------------------------------------
 */
	$_ENTITIES = new System\Library\EntitiesHandler($DB);

/*
 * ------------------------------------------------------
 *  Instantiate the Router class
 * ------------------------------------------------------
 */
	$RTR = new System\Core\Router($_ENTITIES);
	
/*
 * ------------------------------------------------------
 *  Instantiate the Session class
 * ------------------------------------------------------
 */
	$SESSION = new System\Core\Session($CFG, $HTTPRQST);
	
/*
 * ------------------------------------------------------
 *  Verify that the user is not banned
 * ------------------------------------------------------
 */
	if(isBannned())
	{
		show_error(ERROR_LEVEL_FATAL, 'Acess Denied', 'You have been banned from this web site.');
	}

/*
 * ------------------------------------------------------
 *  Load the application
 * ------------------------------------------------------
 *
 */
 	// Load the route class corresponding to the user URI
	$route = $RTR->getRoute($HTTPRQST->getURL());
	
	if (is_dir(APPPATH.$route->application()))
	{
		$app = new System\Core\Application($route, $HTTPRQST, $HTTPRESP, $SESSION, $CFG, $_ENTITIES);
		$app->run();
	}
	else
	{
		show_error(ERROR_LEVEL_FATAL, 'Not Found', 'Application Directory does not exist.');
	}
	
?>