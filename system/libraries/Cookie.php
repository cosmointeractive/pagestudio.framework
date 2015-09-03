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
 
class Cookie 
{
    /**
     * Check if a given cookie exists
     *
     * @access     public 
     * @var        string $name The cookie name
     * @return     bool True or False
     */
    public static function exists($name)
    {
        return isset($_COOKIE["$name"]) ? true : false;
    }
    	
	public static function get($name)
	{
		return isset($_COOKIE["$name"]) ? $_COOKIE["$name"] : 0;
	}
    
    /**
     * Method to set a cookie
     *
     * @access     public 
     * @var        $name 
     * @var        $value
     * @var        $expiry
     */
    public static function set($name, $value, $expiry) 
    {
        if(setcookie($name, $value, time() + $expiry, '/')) {
            return true;
        }
        return false;
    }
	
    /**
     * Method to delete/reset a cookie
     * 
     * @access     public 
     * @var        string $name The cookie to reset
     */
    public static function delete($name)
    {
        self::set($name, '', time() - 1); 
    }    
}

/* End of file Cookie.php */
/* Location: ./system/libraries/Cookie.php */