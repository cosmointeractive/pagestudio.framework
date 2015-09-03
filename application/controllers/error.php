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

class Error extends Controller {
	
	public function index()
	{
        $data = array('heading' => '404 Error', 'message' => 'Looks like this page doesn\'t exist');
		$template = $this->loadView('error_view');
        $this->benchmark->mark('code_end');
        $template->set('page', $data);
        $template->set('elapsed_time', $this->benchmark->elapsed_time('code_start', 'code_end'));
		$template->render();
	}
}

/* End of file Error.php */
/* Location: ./application/controllers/Error.php */