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
	
	require_once(BASEPATH.'Config/Constants.php');

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
 *  Instantiate the globals classes
 * ------------------------------------------------------
 */
	$GLOBALS['$_CFG'] = new System\Core\Config();
	$GLOBALS['$_HTTPRQST'] = new System\Core\HTTPRequest();
	$GLOBALS['$_HTTPRESP'] = new System\Core\HTTPResponse();
	$GLOBALS['$_DB_HANDLER'] = new System\Library\DatabaseHandler();
	$GLOBALS['$_MODELS_HANDLER'] = new System\Library\ModelsHandler();
	$GLOBALS['$_RTR'] = new System\Core\Router();
	$GLOBALS['$_SESSION'] = new System\Core\Session();
	
/*
 * ------------------------------------------------------
 *  Generate generals configuartions
 * ------------------------------------------------------
 */
	// Load the Generals Configurations
	$GLOBALS['$_CFG']->load_general_config();

	// Do we have any manually set config items in the index.php file?
	if (isset($assign_to_config) && is_array($assign_to_config))
	{
		foreach ($assign_to_config as $key => $value)
		{
			$GLOBALS['$_CFG']->setConfig(CFG_GENERAL, $key, $value);
		}
	}

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
	$app_route = $GLOBALS['$_RTR']->getRoute($GLOBALS['$_HTTPRQST']->getURL());
	
	if (is_dir(APPPATH.$app_route->application()))
	{
		$app_class = 'Applications\\'.$app_route->application().'\\'.ucfirst($app_route->application()).'Application';
		$app = new $app_class($app_route);
		$app->run();
	}
	else
	{
		show_error(ERROR_LEVEL_FATAL, 'Application Error', 'Application Directory does not exist.');
	}
	
?>