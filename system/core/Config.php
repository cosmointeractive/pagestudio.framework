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

class Config 
{
    /**
     * Method to get config variables
     *
     * @example     Config::get('mysql/host')
     *
     * @access      public
     * @param       $path The config item in the array we are accessing
     * @var         $config Variable where our config is coming from
     */
    public static function get($path = null)
    {
        if($path) {
            $config = $GLOBALS['config'];
            $path = explode('/', $path);
            
            //Look through the config array and set it if it exists
            foreach($path as $bit) {
                if(isset($config[$bit])) {
                    $config = $config[$bit];
                }
            }
            
            return $config;
            
        } else {
            return false;
        }
    }
}

/* End of file config.php */
/* Location: ./system/config.php */