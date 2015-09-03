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
 * System Initialization File
 *
 * Loads the base classes and executes the request.
 *
 * @package		PageStudio
 * @category	Front-controller
 * @author      Cosmo Mathieu <cosmo@cosmointeractive.co>
 * @link		http://pagestudio.com/user_guide/
 */
    
// Set our defaults
global $config;
$url = '';

// Includes
require APPPATH  . 'config/config.php';
// require APPPATH . 'config/autoload.php';
require BASEPATH . 'core/Benchmark.php';
require BASEPATH . 'core/router.php';
require BASEPATH . 'core/model.php';
require BASEPATH . 'core/view.php';
require BASEPATH . 'core/controller.php';
// require SYSDIR  . '/autoloader.php';

// Define absolute path
define('ABSPATH', str_replace('system/', '', BASEPATH));

// Define base URL
define ('BASE_URL', $config['base_url']);    
// define('BASE_URL', Config::get('base_url'));

// Get request url and script url
$request_url = (isset($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : '';
$script_url  = (isset($_SERVER['PHP_SELF'])) ? $_SERVER['PHP_SELF'] : '';
    
// Get our url path and trim the / of the left and the right
if($request_url != $script_url) {
    $url = trim(
        preg_replace('/'. str_replace('/', '\/', 
                str_replace('index.php', '', $script_url)
            ) .'/', '', $request_url, 1
        ), '/'
    );
}     

/**
 * Get Router
 */
// $uri = isset($_GET['uri']) ? $_GET['uri'] : null;
$router = new Router($url, $config['routes']);
$router->dispatch();

// Router::run($url, $config['routes'])->dispatch();

/* End of file pip.php */
/* Location: ./system/pip.php */