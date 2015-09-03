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
 * Auto-Loader
 *
 * This file specifies which systems should be loaded by default.
 *
 * In order to keep the framework as light-weight as possible only the
 * absolute minimal resources are loaded by default. For example,
 * the database is not connected to automatically since no assumption
 * is made regarding whether you intend to use it.  This file lets
 * you globally define which systems you would like loaded with every
 * request.
 *
 * -------------------------------------------------------------------
 * Instructions
 * -------------------------------------------------------------------
 *
 * These are the things you can load automatically:
 *
 * 1. Packages
 * 2. Libraries
 * 3. Helper files
 * 4. Custom config files
 * 5. Language files
 * 6. Models
 *
 */

/**
 *  Auto-load Packges
 * -------------------------------------------------------------------
 * 
 * Prototype:
 *
 * $autoload['packages'] = array(APPPATH.'third_party', '/usr/local/shared');
 *
 */
$autoload['packages'] = array();


/**
 * -------------------------------------------------------------------
 *  Auto-load Libraries
 * -------------------------------------------------------------------
 * These are the classes located in the system/libraries folder
 * or in your application/libraries folder.
 *
 * Prototype:
 *
 * $autoload['libraries'] = array('database', 'session', 'xmlrpc');
 */
$autoload['libraries'] = array(
    'Lex/Parser', 
    'FluentPDO/FluentPDO',
    'FluentPDO/FluentStructure',
    'FluentPDO/FluentUtils',
    'FluentPDO/FluentLiteral',
    'FluentPDO/BaseQuery',
    'FluentPDO/CommonQuery',
    'FluentPDO/SelectQuery',
    'FluentPDO/InsertQuery',
    'FluentPDO/UpdateQuery',
    'FluentPDO/DeleteQuery'
);


/**
 * -------------------------------------------------------------------
 *  Auto-load Helper Files
 * -------------------------------------------------------------------
 * Prototype:
 *
 * $autoload['helper'] = array('url', 'file');
 */
$autoload['helper'] = array(
    'error_handler_helper',
    'functions_helper',
);


/**
 * -------------------------------------------------------------------
 *  Auto-load Config files
 * -------------------------------------------------------------------
 * Prototype:
 *
 * $autoload['config'] = array('config1', 'config2');
 *
 * NOTE: This item is intended for use ONLY if you have created custom
 * config files.  Otherwise, leave it blank.
 *
 */
$autoload['config'] = array();


/**
 * Auto-load Language files
 *
 * @example      $autoload['language'] = array('lang1', 'lang2');
 *
 * NOTE: Do not include the "_lang" part of your file.  For example
 * "codeigniter_lang.php" would be referenced as array('codeigniter');
 */
$autoload['language'] = array();


/**
 * -------------------------------------------------------------------
 *  Auto-load Models
 * -------------------------------------------------------------------
 * Prototype:
 *
 * $autoload['model'] = array('model1', 'model2');
 *
 */
$autoload['model'] = array();


/* End of file autoload.php */
/* Location: ./application/config/autoload.php */