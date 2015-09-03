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
 * Method to process input requests, with validation and sanitizing options 
 *
 * @note        Add additional validation functions
 * @subpackage  Libraries
 */
class Input 
{
    /** 
     * Check GET or the POST array is empty or not
     *
     * @access      public
     * @param       string $type Value to check for
     * @return      string Return a string or nothing if empty
     */
    public static function exists($type = 'post', $formField = '')
    {
        switch($type) {
            case 'post':
                return ( ! empty($_POST)) ? true : false;
                break;
            case 'get':
                return ( ! empty($_GET)) ? true : false;
                break;
            case 'upload':
                return self::fileUploaded($formField);
                break;
            default: 
                return false;
                break;
        }
    }
    
    /**
     * Check whether or not $_FILES is empty
     *
     * @access     public 
     * @param      string $formField Upload field name
     * @return     bool 
     */
    public static function fileUploaded($formField)
    {
        if(empty($_FILES)) {
            return false;       
        } 
        if( ! file_exists($_FILES[$formField]['tmp_name']) 
            || !is_uploaded_file($_FILES[$formField]['tmp_name'])
        ) {
            // $errors['FileNotExists'] = true;
            return false;
        }   
        return true;
    }
    
    /** 
     * Fetch an item from the POST or the GET array
     *
     * @access      public
     * @param       string $item Value being returned
     * @return      string
     */
    public static function get($item)
    {
        if(isset($_POST[$item])) {
            return $_POST[$item];
        } else if(isset($_GET[$item])) {
            return $_GET[$item];
        } else {
            return '';
        }
    }
}

/* End of file Input.php */
/* Location: ./system/libraries/Input.php */