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
 
class Session 
{
    /**
     * Check if a given session key exists
     *
     * @access     public 
     * @var        string $key The session key
     * @return     bool True or False
     */
    public static function exists($key)
    {
        return isset($_SESSION["$key"]) ? true : false;
    }
    
	public static function set($key, $val)
	{
		$_SESSION["$key"] = $val;
	}
	
	public static function get($key)
	{
		return isset($_SESSION["$key"]) ? $_SESSION["$key"] : 0;
	}
	
    public static function delete($key)
    {
        if (self::exists($key)) {        
            unset($_SESSION["$key"]);
        } 
    }
    
    /**
     * Method to end all sessions
     * 
     * @access     public 
     */
	public static function destroy()
	{
		session_destroy();
	}
    
    /**
     * Method that provides a flash message
     */
    public static function flash($name, $string = '')
    {
        if(self::exists($name)) {
            $session = self::get($name);
            self::delete($name);
            return $session;
        } else {
            self::set($name, $string);
        }
    }
}

/* End of file Session.php */
/* Location: ./system/libraries/Session.php */