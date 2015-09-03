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
 * Router Class
 *
 * Parses URIs and determines routing.
 * Run URI against our Map array to get class/method/id-page string|numbers
 *
 * @package		PageStudio
 * @subpackage	Libraries
 * @author      Cosmo Mathieu <cosmo@cosmointeractive.co>
 * @category	Libraries
 * @link		http://codeigniter.com/user_guide/general/routing.html
 */
class Router
{        
    /**
	 * List of routes
	 *
	 * @var	array
	 */
	public $routes =	array();
	/**
	 * Current class name
	 *
	 * @var	string
	 */
	public $controller = '';
	/**
	 * Current method name
	 *
	 * @var	string
	 */
	public $method = 'index';
	/**
	 * Sub-directory that contains the requested controller class
	 *
	 * @var	string
	 */
	public $directory;
	/**
	 * Default controller (and method if specific)
	 *
	 * @var	string
	 */
	public $default_controller;
    /**
	 * Default controller (and method if specific)
	 *
	 * @var	string
	 */
	public $error_controller;
    /**
	 * Stores original uri 
	 *
	 * @var	string
	 */
    public $uri;
    
    /**
	 * Constructor
	 *
	 * Runs the route mapping function.
     * @return       void
	 */
    public function __construct($uri, $routes = array())
    {
        global $config;
        
        $this->routes = $routes;
        
        // Store the original uri 
        $this->uri = $uri;
        
        // Split the url into segments
        $this->segments = explode('/', $uri);
        
        // Do our default checks
        $this->default_controller  = $config['default_controller'];
        $this->error_controller    = $config['error_controller'];
        $this->controller          = ( ! empty($this->segments[0])) ? $this->segments[0] : $this->default_controller;
        $this->method              = (isset($this->segments[1]) && ! empty($this->segments[1]) !== '') 
                                        ? $this->segments[1] : 'index';
                                        
        $this->run(); 
    }

    // ---------------------------------------------------------------
    
    public function run()
    {
        // if( ! isset(self::$_instance)) {
            // self::$_instance = new DB();
        // }
        
        // self::$_instance->table = $table;
        
        // return self::$_instance;
        
        // Parse routes set in config
        $this->factory();
        
        // Validate the request
        // $this->validate(); 
    }
    
    // ---------------------------------------------------------------
    
    /**
	 *  Parse Routes
	 *
	 * This function matches any routes that may exist in
	 * the config/routes.php file against the URI to
	 * determine if the class/method need to be remapped.
	 *
	 * @access	private
	 * @return	void
	 */
	private function factory()
	{
		// Loop through the route array looking for wild-cards
		foreach ($this->routes as $key => $val) {
            // Is there a literal match?  If so we're done
            if ($key === $this->uri) {          
                $parts = explode('/', $this->routes[$this->uri]);
                $this->controller = $parts[0];
                $this->method = (isset($parts[1])) ? $parts[1] : 'index';
            }
            
			// Convert wild-cards to RegEx
			$key = str_replace(':any', '.+', str_replace(':num', '[0-9]+', $key));

			// Does the RegEx match?
			if (preg_match('#^'.$key.'$#', $this->uri)) {
				// Do we have a back-reference?
				if (strpos($val, '$') !== FALSE AND strpos($key, '(') !== FALSE) {
					$val = preg_replace('#^'.$key.'$#', $val, $this->uri);
				}
                
                $parts = explode('/', $val);
                $this->controller = $parts[0];
                $this->method = (isset($parts[1])) ? $parts[1] : 'index';
			}
		}
	}
    
    // ---------------------------------------------------------------
    
    // private function validate()
    // {
        // // Load static routing before dynamic loading occurs 
        // foreach ($this->routes as $uri => $route) {
            // if(is_array($uri)) {
            // } else {
                // // if (preg_match("#^{$uri[0]}$#Ui", $url, $uri_digits)) {
                // if($uri === $this->controller) { 
                    // $this->controller = $route['controller'];
                    // $this->method = ( ! empty($route['method'])) ? $route['method'] : 'index';
                // }
            // }             
        // }
        // var_dump($this->routes);
    // }
    
    /**
	 * Validates the supplied segments.  Attempts to determine the path to
	 * the controller.
	 *
	 * @access	private
	 * @param	array
	 * @return	array
	 */
    public function dispatch()
    {        
        // Get our controller file
        $path = APP_DIR . 'controllers/' . $this->controller . '.php';
        
        if(file_exists($path)) {
            require_once $path;
        } else {
            require_once APP_DIR . 'controllers/' . $this->error_controller . '.php';
        }
        
        // Check the action exists
        if( ! method_exists($this->controller, $this->method)) {
            $this->controller   = $this->error_controller;
            $this->method       = 'index';
            
            require_once APP_DIR . 'controllers/' . $this->controller . '.php';
        }
        
        // Create object and call method
        $obj = new $this->controller;
        die(call_user_func_array(
            array($obj, $this->method), array_slice($this->segments, 2))
        );
    }
    
    // ---------------------------------------------------------------
    // Utility methods
    // ---------------------------------------------------------------

    public function getController()
    {
        return $this->controller;
    }

    public function getMethod()
    {
        return $this->method;
    }
}
// END Router Class

/* End of file Router.php */
/* Location: ./system/core/Router.php */