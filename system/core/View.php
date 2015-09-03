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
 * Application Controller View Class
 *
 * Loads view files and sends final output to browser
 *
 * @package		PageStudio
 * @author      Cosmo Mathieu <cosmo@cosmointeractive.co>   
 */
class View 
{
    /**
     *
     * @access     private
     */
	private $pageVars = array();
    
    /**
     *
     * @access     private
     */
    private $template;
    
    /**
	 * Constructor
	 *
	 * Sets the path to the view files
	 */
	public function __construct($template)
	{
		$this->template = APPPATH .'views/'. $template .'.php';
	}

	public function set($var, $val)
	{
		$this->pageVars[$var] = $val;
	}
    
    /**
     * Provides a way to add page level view css files
     * 
     * @access      Public 
     */
    public function addCSS($array = '')
    {
        $this->pageLevelCSS = $array;
    }
    
    /**
     * Provides a way to add page level view css files
     * 
     * @access      Public 
     */
    public function addJS($array = '')
    {
        $this->pageLevelJS = $array;
    }
        
    // Return the page level css files in an array
    public function pageCSS()
    {
        return ( ! empty($this->pageLevelCSS)) ? $this->pageLevelCSS : '';
    }
    
    // Return the page level js files in an array
    public function pageJS()
    {
        return ( ! empty($this->pageLevelJS)) ? $this->pageLevelJS : '';
    }
        
    /**
     * Returns the content of the model to the viewer
     * 
     * @array       $pageVars Array containing elements to be displayed
     * @param       $template Variable to be displayed to the viewport   
     */
	public function render()
	{
		extract($this->pageVars);

		ob_start();
		require($this->template);
		echo ob_get_clean();
	}
}

/* End of file View.php */
/* Location: ./system/core/View.php */