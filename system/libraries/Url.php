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
 
class Url 
{
	public static function base_url()
	{
		return Config::get('base_url');
	}
	
    /**
	 * Break down the url into smaller chunks (segments).
	 * Return the segments to the caller. Segments are referenced by needle.
	 * 
	 * @example    $uri->segment(1)
	 * @param      int $segment The segment of the uri to look for
	 * @return     mixed string 
	 */
	public static function segment($segment)
	{
        // Removing spaces before and after
        // $segment = trim($segment);
        
        /** Ensure an int is being passed. */
		if( ! is_int($segment)) {
            return false;
        }
        
        $base_url = Config::get('base_url');
        
        if(strpos($base_url, "http://") !== false) {
            $base_url = str_replace('http://', '', $base_url);
        }
        if(strpos($base_url, "https://") !== false) {
            $base_url = str_replace('https://', '', $base_url);
        }
        if(strpos($base_url, "localhost") !== false) {
            $base_url = str_replace('localhost', '', $base_url);
        }

        /**
		 * Remove base_url from the current url. 
		 */
		$requested_url = str_replace($base_url, '', $_SERVER['REQUEST_URI']);  
        
		/**
		 * Remove double '//' slashes from the string
		 */
		$requested_url =  str_replace("//", "/", $requested_url);

        /**
		 * Split url into chunks using '/' as the delimiter
		 */
        $requested_url = explode('/', $requested_url);
        
        /**
         * !Hack 
         * 
         * Set segment key of 0=>1.
         */
        array_shift($requested_url);
		
		return ( isset($requested_url[$segment]) ) ? $requested_url[$segment] : false;
	}
	
}

/* End of file Url.php */ 
/* Location: ./system/libraries/Url.php */