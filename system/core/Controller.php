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
 * Application Controller Class
 *
 * This class object is the super class that every library in
 * PIP will be assigned to.
 *
 * @package		PageStudio
 * @author		Cosmo Mathieu
 */
class Controller 
{	
    /**
     * Constructor
     *
     * @return      void
     */
    public function __construct()
    {
        $this->benchmark = new Benchmark();
        $this->benchmark->mark('code_start');
        //$this->autoload();
    }
    
    /**
     * Method to autoload objects
     *
     * @note    This does not work.
     * @source  https://github.com/jakiestfu/PIP/blob/master/system/controller.php
     */
    private function autoload()
    {
        global $config;
        foreach( $config['autoload'] as $type => $payload )
        {
            $funcName = 'load' . ucfirst( substr($type, 0, -1) );
            if( is_array($payload) ) {
                foreach($payload as $toLoad)
                {
                    if(method_exists($this,$funcName)) {
                        if( $type == 'helpers' ) {
                            $this->$toLoad = call_user_func(array($this, $funcName), $toLoad);
                        } elseif( $type == 'plugins' ) {
                            call_user_func(array($this, $funcName), $toLoad);
                        }
                    }
                }
            }
        }
    }

	public function loadModel($name)
	{
		require APPPATH .'models/'. strtolower($name) .'.php';

		$model = new $name;
		return $model;
	}
	
	public function loadView($name)
	{
		$view = new View($name);
		return $view;
	}
	
    /**
     * Method to manually load plugins
     *
     * @access      public
     * @var         string $name The plugin file name (minus the extension 
     *              e.g. .php) to load
     */
	public function loadPlugin($name)
	{
		require APPPATH .'plugins/'. strtolower($name) .'.php';
	}
	
    /**
     * Method to manually load helpers
     *
     * @access      public
     * @var         string $name The helper file name (minus the extension 
     *              e.g. .php) to load
     * @return      function 
     */
	public function loadHelper($name)
	{
		require APPPATH .'helpers/'. strtolower($name) .'.php';
		$helper = new $name;
		return $helper;
	}
	
    /**
     * Method to redirect to an internal controller or external page
     *
     * @access      public
     * @var         string $location The controller name or site url
     */
	public function redirect($location)
	{
		header('Location: '. Config::get('base_url') . $location);
	}    
}

/* End of file Controller.php */
/* Location: ./system/core/Controller.php */