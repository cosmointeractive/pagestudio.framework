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
 * Database wrapper
 *
 * Provides an abstract method to work with the database using the PDO engine.  
 * Also includes insert, delete, and update methods to simplify work.
 * Based on the YouTube video by phpAcademy on OOP.
 * For further improvements http://www.phpclasses.org/package/8933-PHP-Wrapper-to-access-MySQL-databases-using-PDO.html#view_files/files/57797
 */
class Database 
{
    /**
     * Private static property 
     * @access      private
     * @var         $_instance Store instance of the database
     */
    private static $_instance = null;     
    
    /**
     * Private variables 
     */
    private $_pdo,              // storage for PDO object
            $_query,            // Stored query
            $_error = false,    // PDO exception error 
            $_results,          // Results of the database query
            $_count = 0;        // Store results returned
    
    /**
     * Constructor
     */
    private function __construct()
    {
        try {
            $this->_pdo = new PDO(
                'mysql:dbname=' . Config::get('mysql/db') . ';' .
                'host=' . Config::get('mysql/host'), 
                Config::get('mysql/username'),   //Username
                Config::get('mysql/password')    //Password
            );
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }
    
    /**
     * Return the database instance object, create the object if not set
     * 
     * @access     public
     * @param      $_instance 
     * @return     object
     */
    public static function getInstance()
    {
        if( ! isset(self::$_instance)) {
            self::$_instance = new Database();
        }
        return self::$_instance;
    }
    
    /**
     * Method to prepare SQL statements
     *
     * @access     public
     * @param      string $sql 
     * @param      array $params Array containing SQL parameters
     * @return     object
     */
    public function query($sql, $params = array()) 
    {
        $x = 1;
        $this->_error = false;
        if($this->_query = $this->_pdo->prepare($sql)) {
            if(count($params)) {
                foreach($params as $param) {
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }
            
            /**
             * Extract bind PDO values if query executed properly
             * and return result sets
             */
            if($this->_query->execute()) {
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
            } else {
                $this->_error = true;
            }
        }
        
        return $this;
    }
    
    /**
     * Prepare statement 
     *
     * Provides a quick and simplified method to make conditional queries
     * 
     * @access     public
     * @param      var $action Field to look up
     * @param      string $table Table to access
     * @param      array $where Array to hold Value of the query
     * @return     Object
     */ 
    public function action($action, $table, $where = array()) 
    {
        /**
         * Check that all values are passed in
         */
        if(count($where) === 3) {
            $operators  = array('=', '<', '>=', '<=');
            
            /**
             * Extract variables from array $where
             */
            $field      = $where[0];
            $operator   = $where[1];
            $value      = $where[2];
            
            //Check if operator is of allowed type
            //Perform query if condition is met
            // if (in_array($operator, $operators)) {
                // $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
                // if( ! $this->query($sql, array($value))->error()) {
                    // return $this;
                // }
            // }
            
            /** @note     Adding the ability to do AND statements. */
            if (in_array($operator, $operators)) {
                if(is_array($value)) {
                    $cnt = 0;
                    foreach($value as $condition) {
                        $x = "{$field} {$operator} ?";
                        if($cnt > 0) {
                            $x .= " AND {$field} {$operator} ?";
                        } 
                        $cnt++;
                    }
                } else {
                    $x = "{$field} {$operator} ?";
                }                
                
                $sql = "{$action} FROM {$table} WHERE ";
                $sql .= $x;
                if( ! $this->query($sql, array($value))->error()) {
                    return $this;
                }
            }
        }
    }
    
    /**
     * Return the results of the query
     * 
     * @access     public
     * @param      array $_results
     * @return     object
     */ 
    public function results() 
    {
        return $this->_results;
    }
    
    /**
     * Prepare statement 
     *
     * Provides a simplified method to make queries
     * 
     * @access     public
     * @param      
     * @return     
     */ 
    public function get($table, $where) 
    {
        return $this->action('SELECT *', $table, $where);
    }
    
    /**
     * Method to simplify database object item
     *
     * @access     public
     * @param      var $table Database table to access
     * @param      var $where 
     * @return     bool
     */ 
    public function delete($table, $where) 
    {
        return $this->action('DELETE', $table, $where);
    }
    
    /**
     * Method to insert data into the MySQL table. This function prepares 
     * the sql PDO query, executes it and return true/false respectively
     *
     * @access     public
     * @param      var $table Database table to access
     * @param      array $fields Fields to update
     * @return     bool
     */
    public function insert($table, $fields = array()) 
    {
        //Check if fields has any value
        if(count($fields)) {
            $keys = array_keys($fields);
            $values = null;
            $x = 1;
            
            //Bind values in the array to the "?" character 
            foreach($fields as $field) {
                $values .= "?";
                if($x < count($fields)) {
                    $values .= ', ';
                }
                $x++;
            }            
            
            $sql = "INSERT INTO " . $table . " (`" . implode('`, `', $keys) . "`) VALUES ({$values})";

            if( ! $this->query($sql, $fields)->error()) {
                return true;
            }
        }
        return false;
    }
    
    /**
     * Method to update a table record
     *
     * <code>     
     * Database::getInstance()->update($table, $id, array(
     *     $field => $value
     * )
     * </code>
     *
     * @access     public
     * @param      var $table
     * @param      int $id
     * @param      array $fields
     */
    public function update($table, $id, $fields = array(), $field = 'id') 
    {
        //Check if fields has any value
        if(count($fields)) {
            $set = '';
            $x = 1;
            
            foreach($fields as $name => $value) {
                $set .= "{$name} = ?";
                if($x < count($fields)) {
                    $set .= ', ';
                }
                $x++;
            }            
            
            $sql = "UPDATE {$table} SET {$set} WHERE {$field} = {$id}";

            if( ! $this->query($sql, $fields)->error()) {
                return true;
            }
        }
        return false;
    }
    
    /**
     * Provides a way to check if a query was successful or not
     * 
     * @access     public
     * @param      int $_count The count of a query attempt
     * @return     int 
     */ 
    public function count() 
    {
        return $this->_count;
    }
    
    /**
     * Return PDO Exception errors 
     * 
     * @access     public
     * @param      int $_error The error count
     * @return     bool
     */ 
    public function error() 
    {
        return $this->_error;
    }
    
}

/* End of file Database.php */
/* Location: ./system/libraries/Database.php */