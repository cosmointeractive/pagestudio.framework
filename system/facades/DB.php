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
 * This class acts as a facafde in the likes of Laravel. 
 *
 * Provides a simple accessor to the Database object 
 *
 * @subpackage Libraries
 * @author      Cosmo Mathieu <cosmo@cosmointeractive.co>
 * @link        http://cosmointeractive.co
 */
class DB
{
    /**
     * Private static property 
     * @access      private
     * @var         $_instance Store instance of the database
     */
    private static $_instance = null;  
    
    /**
     * Creates or grabs an instance of the object 
     * 
     * @param   string $table 
     * @return  object 
     */
    public static function get_instance($table)
    {
        if( ! isset(self::$_instance)) {
            self::$_instance = new Database($table);
        }
        
        return self::$_instance;
    }
    
    //--------------------------------------------------------------------

    /**
     * Sets the table to be queried
     * 
     * @param   string $table 
     * @return  object 
     */
    public static function table($table)
    {
        self::get_instance($table)->table = $table;
        
        return self::$_instance;
    }

    //--------------------------------------------------------------------
    
    public static function result()
    {
        // return self::$_instance->get_result();
    }
}

/* End of file DB.php */
/* Location: ./system/facades/DB.php */