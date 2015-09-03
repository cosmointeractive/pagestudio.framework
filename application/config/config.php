<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
 * DEFAULT SERVER TIMEONE
 * SET the server's default timezone 
 */
date_default_timezone_set('America/New_York'); 	

/**
 * Application Configuration
 *
 * This is the new method to register our config
 *
 *-------------------------------------------------------------------------
 * Explanation of variables
 *-------------------------------------------------------------------------
 * [base_url]           URL to your application root including trailing slash
 *                      e.g. http://example.com/ or http://localhost/
 *                      If this is not set the application will throw an error
 *
 * [default_controller] Default controller to load
 * [error_controller]   Controller used for errors (e.g. 404, 500 etc)
 * [host]               Database host (e.g. localhost)
 * [mysql]              Database to access
 * [logs]               Array of log files
 * [logs][error]        The name of the error log file
 * [cache]              
 * [cache][driver]      
 * [routes]             Map URI to class/method. Must be an array
 *
 * @source     https://www.youtube.com/watch?v=JQkfAdZbAJE
 * @global     mixed $GLOBALS['config'] Holder of all configuration variables
 */
$GLOBALS['config'] = array(    
    'base_url' => '',
    'default_controller' => 'main',
    'login_controller' => 'login',    
    'error_controller' => 'error',    
    'mysql' => array(
        'host'      => '',
        'db'        => '',
        'username'  => '',
        'password'  => '',
    ), 
    'logs' => array(
        'error'     => 'error.log'
    ),
    'cache'         => array(
        'driver'    => '',
        'name'      => 'default',
        'extension' => '.cache',
        'file_path' => 'public_html/cache/'
    ), 
    'routes' => array( 
        'about'          => 'main',
        'blog/pages'     => 'main/nope/2',
        'blog/post'      => 'main/index',
        'blog/post/:num' => 'main/index/2',
        // 'blog/:any' => 'main/post/'
    )
);

/* End of file config.php */ 
/* Location: ./application/config/config.php */