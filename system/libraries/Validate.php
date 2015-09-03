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
 
class Validate 
{
    private $_passed = false,
            $_errors = array(),
            $_db = null;
    
    public function __construct()
    {
        $this->_db = Database::getInstance();
    }
    
    /**
     *
     */
    public function check($source, $items = array()) 
    {
        foreach($items as $item => $rules) {
            foreach ($rules as $rule => $rule_value) {
                $value = trim($source[$item]);
                if($rule === 'required' && empty($value)) {
                    $this->addError("{$item} is required");
                } elseif( ! empty($value)) {
                    switch($rule) {
                        case 'min':
                            if(strlen($value) < $rule_value) {
                                $this->addError("{$item} must be a minimum of {$rule_value} character.");
                            }
                            break;
                        case 'max':
                            if(strlen($value) > $rule_value) {
                                $this->addError("{$item} must be a minimum of {$rule_value} character.");
                            }
                            break;
                        case 'unique':
                            $this->_db->get($rule_value, array($item, '=', $value));
                            if($this->_db->count()) {
                                $this->addError("This {$item}: <b>".$value."</b> already exists in the database.");
                            }
                            break;
                    }
                }
            }
        }
        
        if(empty($this->_errors)) {
            $this->_passed = true;
        }
    }
    
    public function passed() 
    {
        return $this->_passed;
    }
    
    private function addError($error)
    {
        $this->_errors[] = $error;
    }
    
    public function errors()
    {
        return $this->_errors;
    }
}

/* End of file Validate.php */
/* Location: ./system/libraries/Validate.php */