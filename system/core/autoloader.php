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
 * @author      Cosmo Mathieu <cosmo@cimwebdesigns.com>   
 */
 
// ------------------------------------------------------------------------

/**
 * Autoload Objects
 *
 * Autoload Objects with files located in the libraries and system folders only.
 * File names must math the name of the Object defined within to be autoloaded.
 * 
 * @param    string $class Object name to be invoked 
 */
spl_autoload_register(function($fileName) {
    
    $fileName = ucfirst($fileName);
    
    if (file_exists(SYSDIR . '/libraries/' . $fileName . '.php')) {
        require_once SYSDIR . '/libraries/' . $fileName . '.php';        
    } 
    elseif (file_exists(APPPATH . 'libraries/' . $fileName . '.php')) {
        require_once APPPATH . 'libraries/' . $fileName . '.php';        
    } 
    elseif(file_exists(SYSDIR . '/core/' . $fileName . '.php')) {
        require_once SYSDIR . '/core/' . $fileName . '.php';
    }
});

/**
 * Autoload Configuration files
 * 
 * Anything in this array will be loaded automatically. 
 *
 * @see        ./application/config/autoload.php for a complete list
 */
foreach($autoload['config'] as $config) {
    $file = APPPATH . 'config/' . $config . '.php';
    if (file_exists($file)) {
        require $file;
    } else {
        // log_message('8', 'File ' . $file . ' was not found on the server.', __FILE__, '46');
    }
}

/**
 * Autoload Language files
 * 
 * Anything in this array will be loaded automatically. 
 *
 * @see        ./application/config/autoload.php for a complete list
 */
foreach($autoload['language'] as $language) {
    $file = APPPATH . 'language/' . $language . '.php';
    if (file_exists($file)) {
        require $file;
    } else {
        // log_message('8', 'File ' . $file . ' was not found on the server.', __FILE__, '62');
    }
}

/**
 * Autoload Models
 * 
 * Anything in this array will be loaded automatically. 
 *
 * @see        ./application/config/autoload.php for a complete list
 */
foreach($autoload['model'] as $models) {
    $file = APPPATH . 'models/' . $models . '.php';
    if (file_exists($file)) {
        require $file;
    } else {
        // log_message('8', 'File ' . $file . ' was not found on the server.', __FILE__, '78');
    }
}

/**
 * Autoload Helpers
 * 
 * Anything in this array will be loaded automatically. 
 *
 * @see        ./application/config/autoload.php for a complete list
 */
foreach($autoload['helper'] as $helper) {
    $file = APPPATH . 'helpers/' . $helper . '.php';
    if (file_exists($file)) {
        require $file;
    } else {
        // log_message('8', 'File ' . $file . ' was not found on the server.', __FILE__, '94');
    }
}

/**
 * Autoload Libraries
 * 
 * Anything in this array will be loaded automatically. 
 *
 * @see        ./application/config/autoload.php for a complete list
 */
foreach($autoload['libraries'] as $libraries) {
    $file = APPPATH . 'libraries/' . $libraries . '.php';
    if (file_exists($file)) {
        require $file;
    } else {
        // log_message('8', 'File ' . $file . ' was not found on the server.', __FILE__, '110');
    }
}

/* End of file autoloader.php */
/* Location: ./application/config/autoloader.php */