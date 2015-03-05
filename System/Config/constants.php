<?php  

/*
|--------------------------------------------------------------------------
| Directories' paths
|--------------------------------------------------------------------------
|
| These constants will help you to access to the framework's directories 
| easily. DO NOT CHANGE THESE CONFIGURATIONS.
|
*/
	define('WEB_PATH', __DIR__);
	define('BASE_PATH', str_replace("\\", "/", realpath('../')).'/');

	define('SYS_PATH', BASE_PATH.'System/');
	define('LIB_PATH', SYS_PATH.'Libraries/');
	define('CFG_PATH', SYS_PATH.'Config/');
	define('CORE_PATH', SYS_PATH.'Core/');

	define('SRC_PATH', BASE_PATH.'Sources/');
	define('APP_PATH', SRC_PATH.'Applications/');
	define('MOD_PATH', SRC_PATH.'Models/');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
	define('FILE_READ_MODE', 0644);
	define('FILE_WRITE_MODE', 0666);
	define('DIR_READ_MODE', 0755);
	define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
	define('FOPEN_READ',							'rb');
	define('FOPEN_READ_WRITE',						'r+b');
	define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
	define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
	define('FOPEN_WRITE_CREATE',					'ab');
	define('FOPEN_READ_WRITE_CREATE',				'a+b');
	define('FOPEN_WRITE_CREATE_STRICT',				'xb');
	define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/*
|--------------------------------------------------------------------------
| User Ranks
|--------------------------------------------------------------------------
|
| This is the ranks of the users
|
*/
	define('USER_VISITOR', 			0);
	define('USER_MEMBER', 			1);
	define('USER_MODERATOR', 		2);
	define('USER_ADMINISTRATOR', 	3);

/*
|--------------------------------------------------------------------------
| Config Types
|--------------------------------------------------------------------------
|
| This is the types
|
*/
	define('CFG_GENERAL',	1);
	define('CFG_DATABASE', 	2);
	define('CFG_APP',		3);
	define('CFG_SERVER',	4);

/*
|--------------------------------------------------------------------------
| Errors Levels
|--------------------------------------------------------------------------
|
| This is the types
|
*/
	define('ERROR_LEVEL_WARN',	1);
	define('ERROR_LEVEL_ERROR',	1);
	define('ERROR_LEVEL_FATAL', 	2);

/*
|--------------------------------------------------------------------------
| Others Definitions
|--------------------------------------------------------------------------
|
*/
	define('CRYPT_SALT', '8Rds4a820Pql7Z');

?>