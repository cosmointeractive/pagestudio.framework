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
 
class Token
{   
    /* DEPRECATED
    public static function gen()
    {
        $_token = md5(uniqid(mt_rand(),true));
        Session::set(Config::get('session/session_token'), $_token);
        
        return $_token;
    } 
    */
    
    /**
     * Method to generate secure random tokens
     *
     * @require    string $formName 
     * @require    $stringLength (length of token to generate)
     * @var        string $_token The randomly generated token
     * @return     string Returns an randomly generated token
     */ 
    public static function gen($stringLength = 8, $formName = '') 
    {	
        /** Generate a random alphanumeric token. */	
        $_token = random_alphanumeric( $stringLength );
        
        /** Concatenate the token salt unto the token and hash it. */
        $_token = $_token . md5( $_token . Config::get('session/token_salt') );
        
        /**
         * Write the generated token to the session array
         * - Session::set($formName, $_token) Alternative option
         */
        Session::set(Config::get('session/session_token'), $_token);
        
        return $_token;
    }

    /**
     * Method to validate a token stored in the session. 
     *
     * @required   string $token The token to check for
     * @param      string $sessionToken Token stored in the session
     * @return     bool Return true or false
     */
    public static function validate($token)
    {
        /** Get the token from the session. */
        $sessionToken = Config::get('session/session_token');
        
        /** Check passed token against the version stored in the session. */
        if(Session::exists($sessionToken) && $token === Session::get($sessionToken)) {
            Session::delete($sessionToken);
            
            return true;
        }
    }
    
    /**
     * THIS METHOD IS IN BETA
     * Alternative method to validate the token. This process reverse 
     * engineers the token as oppose to the method above which simply 
     * does a match comparison. 
     * This method assumes the original string length to have been 8 characters.
     * The method gen() above allows for characters above 8 and therefore renders
     * this method useless as a validator. 
     */
    public function validate_token( $string ) 
    {
        $rs = substr( $string, 0, 8 );
        return $string == $rs . substr(
            md5($rs . Config::get('session/token_salt')), 
            ord($string[7])-65, 8
        );
    }
}

/* End of file Token.php */
/* Location: ./system/libraries/Token.php */