<?php
/**
 * PageStudio
 *
 * A web application for managing website content. For use with PHP 5.4+
 * 
 * This application is based on the PHP framework, 
 * PIP http://gilbitron.github.io/PIP/. PIP has been greatly altered to 
 * work for the purposes of our development team. Additional resources 
 * and concepts have been borrowed from CodeIgniter,
 * http://codeigniter.com for further improvement and reliability. 
 *
 * @package     PageStudio
 * @author      Cosmo Mathieu <cosmo@cosmointeractive.co>
 */

// ------------------------------------------------------------------------

/**
 * Start the Session
 */
if( ! isset($_SESSION)) {
    session_start();
}

/**
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
 * @note If you change these, also change the error_reporting() code below
 *
 */
	define('ENVIRONMENT', 'development');

/**
 *---------------------------------------------------------------
 * ERROR REPORTING
 *---------------------------------------------------------------
 *
 * Different environments will require different levels of error reporting.
 * By default development will show errors but testing and live will hide them.
 */
if (defined('ENVIRONMENT')) {
	switch (ENVIRONMENT)
	{
		case 'development':
			error_reporting(E_ALL);
		break;

		case 'testing':
		case 'production':
			error_reporting(0);
		break;

		default:
			exit('The application environment is not set correctly.');
	}
}

/**
 *---------------------------------------------------------------
 * SYSTEM FOLDER NAME
 *---------------------------------------------------------------
 *
 * This variable must contain the name of your "system" folder.
 * Include the path if the folder is not in the same  directory
 * as this file.
 *
 */
	$system_path = 'system';

/**
 *---------------------------------------------------------------
 * APPLICATION FOLDER NAME
 *---------------------------------------------------------------
 *
 * If you want this front controller to use a different "application"
 * folder then the default one you can set its name here. The folder
 * can also be renamed or relocated anywhere on your server.  If
 * you do, use a full server path. For more info please see the user guide:
 * http://codeigniter.com/user_guide/general/managing_apps.html
 *
 * NO TRAILING SLASH!
 *
 */
	$application_folder = 'application';

/**
 *---------------------------------------------------------------
 * Resolve the system path for increased reliability
 *---------------------------------------------------------------
 */
    // Set the current directory correctly for CLI requests
    if (defined('STDIN')) {
        chdir(dirname(__FILE__));
    }

    if (realpath($system_path) !== FALSE) {
        $system_path = realpath($system_path).'/';
    }

    // ensure there's a trailing slash
    $system_path = rtrim($system_path, '/').'/';

    // Is the system path correct?
    if ( ! is_dir($system_path)) {
        exit("Your system folder path does not appear to be set correctly. Please open the following file and correct this: ".pathinfo(__FILE__, PATHINFO_BASENAME));
    }

/**
 *-------------------------------------------------------------------
 * Now that we know the path, set the main path constants
 *-------------------------------------------------------------------
 */
	// The name of THIS file
	define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));

	// Path to the system folder
	define('BASEPATH', str_replace("\\", "/", $system_path));

	// Path to the front controller (this file)
	define('FCPATH', str_replace(SELF, '', __FILE__));

	// Name of the "system folder"
	define('SYSDIR', trim(strrchr(trim(BASEPATH, '/'), '/'), '/'));

	// The path to the "application" folder
	if(is_dir($application_folder)) {
		define('APPPATH', $application_folder.'/');
	} else {
		if( ! is_dir(BASEPATH.$application_folder.'/')) {
			exit("Your application folder path does not appear to be set correctly. Please open the following file and correct this: ".SELF);
		}

		define('APPPATH', BASEPATH.$application_folder.'/');
	}

/**
 *--------------------------------------------------------------------
 * LOAD THE BOOTSTRAP FILE
 *--------------------------------------------------------------------
 *
 * This file invokes everything that should run at start
 * @see         ./system/pip.php
 *
 * And away we go...
 */
require BASEPATH .'core/pip.php';

/* End of file index.php */
/* Location: ./index.php */