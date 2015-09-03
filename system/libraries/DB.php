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

/**
 * Database query builder | wrapper
 *
 * Provides an abstract method to handle common database queries and operations. 
 * Also includes insert, delete, and update methods to simplify work.
 * Based on the YouTube video by phpAcademy on OOP.
 * For further improvements http://www.phpclasses.org/package/8933-PHP-Wrapper-to-access-MySQL-databases-using-PDO.html#view_files/files/57797
 *
 * @subpackage Libraries
 * @link       http://cosmointeractive.co
 */
class DB
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
            
            /** @todo      Rename $_query to $_status */
            $_error = false,    // PDO exception error 
            
            $_results,          // Results of the database query
            $_count = 0,        // Store results returned
            $_errorInfo = array(); // PDO exceltion error 
            
    private $query      = 'null',
            $table      = 'null', 
            $condition  = '',
            $clause     = '',
            $operators  = array('=', '<', '>', '>=', '<='),
            $limit      = 1, 
            $select_first = '';
    
    /**
     * Constructor
     * 
     * Instantiate the PDO object
     * return      void
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

    // -------------------------------------------------------
    
    /**
     * Method to prepared SQL statements, execute, and fetch results
     *
     * @access     public
     * @param      string $sql 
     * @param      array $params Array containing SQL parameters
     * @return     object
     */
    private function query($sql, $params = array()) 
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
                // Select single row from db if the "first" method is triggered
                if($this->select_first) {
                    $this->_results = $this->_query->fetch(PDO::FETCH_OBJ);
                } else {
                    $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                }
                
                $this->_count = $this->_query->rowCount();
                
            } else {
                $this->_error = true;
                $this->_errorInfo = $this->_query->errorInfo();
            }
        }
        
        return $this;
    }
    
    // -------------------------------------------------------
    
    /**
     * Method to prepare SQL statements
     *
     * Provides a quick and simplified method to make conditional query bindings
     * 
     * @access     public
     * @param      var $action Field to look up
     * @param      string $table Table to access
     * @param      array $where Array to hold Value of the query
     * @return     Object
     */ 
    private function action($action, $table, $where = array()) 
    {
        /**
         * Check that all values are passed in
         */
        if(count($where) === 3) {
            
            /**
             * Extract variables from array $where
             */
            $field      = $where[0];
            $operator   = $where[1];
            $value      = $where[2];

            /** @note     Adding the ability to do AND statements. */
            if (in_array($operator, $this->operators)) {
                if(is_array($value)) {
                    $cnt = 0;
                    foreach($value as $condition){
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
        
        if(empty($where)) {            
            $sql = "{$action} FROM {$table}";
            if( ! $this->query($sql, array())->error()) {
                return $this;
            }
        }
    }

    // -------------------------------------------------------
    
    private function sql($param = '')
    {
        $param = ( ! empty($param)) ? $param : 'SELECT *'; // The statement partial 
        
        if( ! empty($this->clause)) {
            if(count($this->clause) === 3) {
                return $this->action($param, $this->table, array(
                    $this->clause['field'], 
                    $this->clause['operator'],
                    $this->clause['value'])
                );
                
            } else {
                return $this->action($param, $this->table, array(
                    $this->clause['field'], 
                    '=', 
                    $this->clause['value'])
                );
            }
            
        } else {
            return $this->action($param, $this->table, '');
        }
    }
    
    // -------------------------------------------------------
    
    public static function table($table)
    {
        if( ! isset(self::$_instance)) {
            self::$_instance = new DB();
        }
        
        self::$_instance->table = $table;
        
        return self::$_instance;
    }
    
    // -------------------------------------------------------
    
    /**
     * Method to execute raw queries 
     * 
     * @todo       Write the functions of this method...
     * @access     public
     * @param      $_instance 
     * @return     object
     */
    public static function select($table = null)
    {
        
    }
    
    // -------------------------------------------------------
    
    /**
     * Prepare statement clause
     *
     * Provides a simplified method to make queries
     * 
     * @access     public
     * @param      
     * @return     object
     */ 
    public function where($field = '', $value = '', $optional = '') 
    {
        if( ! empty($optional)) {
            if (in_array($value, $this->operators)) {
                $this->clause = array(
                    'field' => $field,
                    'operator' => $value,
                    'value' => $optional
                ); 
            }
        } else {
            $this->clause = array(
                'field' => $field,
                'value' => $value
            );
        }
        
        return $this;
    }

    // -------------------------------------------------------
    
    /**
     * Return the results of the query
     * 
     * @access     public
     * @param      object $_results The results of the query
     * @return     object
     */ 
    public function get() 
    {
        $this->sql();
        return $this->_results;
    }
    
    // -------------------------------------------------------
    
    // trigger
    public function first() 
    {
        $this->select_first = 1;
        $this->sql();
        return $this->_results;
    }
    
    // -------------------------------------------------------
    
    // chain
    public function limit($size)
    {
        $this->limit = $size;
        return $this;
    }

    // chain
    public function sort($order)
    {
        $this->order = 'ORDER BY ' . strtoupper(trim($order));
        return $this;
    }

    // -------------------------------------------------------
        
    /**
     * Method to insert data into the MySQL table. This function prepares 
     * the sql PDO query, executes it and return true/false respectively
     *
     * @access     public
     * @param      array $fields Fields to update
     * @return     bool
     */
    public function insert($fields = array()) 
    {        
        $items = count($fields);
        if($items > 1) {                
            // Check if is multi-dimentional
            if(@ is_array($fields[0])) {
                foreach($fields as $fields) {
                    $this->insert($fields);
                    $items = $items - 1;
                }
            } 
        }
            
        // Check if fields has any value
        if($items) {

            $keys = array_keys($fields);
            $values = null;
            $x = 1;
            
            // Bind values in the array to the "?" character 
            foreach($fields as $field) {
                $values .= "?";
                if($x < count($fields)) {
                    $values .= ', ';
                }
                $x++;
            } 
                        
            $sql = "INSERT INTO " . $this->table . " (`" . implode('`, `', $keys) . "`) VALUES ({$values})";

            if( ! $this->query($sql, $fields)->error()) {
                return true;
            }
        }
        
        return false;
    }
    
    // -------------------------------------------------------
    
    /**
     * Method to update a table record
     *
     * <code>     
     *  DB::table('users')->where('id', 1)->update(['post_status' => 'published']);
     * </code>
     *
     * @access     public
     * @param      var $table
     * @param      int $id
     * @param      array $fields
     */
    public function update($fields = array()) 
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
            
            $stmt = "UPDATE {$this->table} SET {$set} WHERE {$this->clause['field']} = {$this->clause['value']}";
            
            if( ! $this->query($stmt, $fields)->error()) {
                return true;
            }
        }
        return false;
    }
    
    // -------------------------------------------------------
    
    /**
     * Method to delete records from a table
     *
     * @access     public
     * @param      var $table Database table to access
     * @param      var $where 
     * @return     bool
     */ 
    public function delete() 
    {
        return $this->sql('DELETE');
    }
    
    // -------------------------------------------------------
    
    public function error()
    {
        $this->_error = true;
    }
}

/* End of file DB.php */
/* Location: ./system/libraries/DB.php */