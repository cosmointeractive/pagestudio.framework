<?php
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

class Main extends Controller {
	
	function index()
	{
        for($i = 0;$i < 100000; $i++) {
            
        }
		$template = $this->loadView('main_view');
        $this->benchmark->mark('code_end');
        $template->set('elapsed_time', $this->benchmark->elapsed_time('code_start', 'code_end'));
		$template->render();
	}
    
}

/* End of file Main.php */
/* Location: ./application/controllers/Main.php */