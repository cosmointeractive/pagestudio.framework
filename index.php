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
 
/*
 * PIP v0.5.3
 */

//Start the Session
session_start(); 

// Defines
define ('BASEPATH', realpath(dirname(__FILE__)) .'/');
define ('ROOT_DIR', realpath(dirname(__FILE__)) .'/');
define ('APP_DIR', ROOT_DIR .'application/');

/*
 * --------------------------------------------------------------------
 * LOAD THE BOOTSTRAP FILE
 * --------------------------------------------------------------------
 *
 * And away we go...
 */
require ROOT_DIR .'system/pip.php';